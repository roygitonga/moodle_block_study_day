<?php
class block_study_day extends block_base {
    
    public function init() {
        $this->title = get_string('pluginname', 'block_study_day');
    }

    public function get_content() {
        global $USER, $DB;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();

        // Get data for polar chart
        $data = $this->get_login_data_for_chart($USER->id);

        // Chart data setup
        $labels = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        $colors = ['#FFA043', '#1F7BF4', 'pink', 'lightgreen', 'gold', 'lightblue', 'blue'];

        // Prepare dataset for Chart.js
        $datasets[] = [
            'label' => get_string('numlogins', 'block_study_day'),
            'data' => $data,
            'backgroundColor' => $colors,
        ];

        // Chart configuration
        $chart_data = [
            'type' => 'polarArea',
            'data' => [
                'labels' => $labels,
                'datasets' => $datasets,
            ],
            'options' => [
                'responsive' => true,
            ],
        ];

        // Render chart HTML
        $chart_html = html_writer::tag('canvas', '', [
            'id' => 'polarchart',
            'width' => '580',
            'height' => '350',
            'aria-label' => 'chart',
        ]);

        // Include Chart.js library
        $chart_html .= html_writer::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js');

        // Script to render the chart
        $chart_html .= html_writer::script('
            var chrt = document.getElementById("polarchart").getContext("2d");
            var polarchart = new Chart(chrt, ' . json_encode($chart_data) . ');
        ');

        // Set content
        $this->content->text = $chart_html;
        $this->content->footer = '';

        return $this->content;
    }

    // Function to get login data for the current user
    private function get_login_data_for_chart($userid) {
        global $DB;

        $sql = "
            SELECT
                DAYNAME(FROM_UNIXTIME(ls.timecreated)) AS DayOfWeek,
                COUNT(*) AS NumLogins
            FROM
                {logstore_standard_log} ls
            WHERE
                ls.userid = :userid
                AND ls.action = 'loggedin'
            GROUP BY
                DayOfWeek
            ORDER BY
                FIELD(DayOfWeek, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
        ";

        $params = ['userid' => $userid];

        $results = $DB->get_records_sql_menu($sql, $params);

        // Initialize data array with zeros for all days
        $data = array_fill_keys(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'], 0);

        // Populate data with actual login counts
        foreach ($results as $day => $count) {
            $data[$day] = intval($count);
        }

        return array_values($data); // Return values as an indexed array
    }
}
