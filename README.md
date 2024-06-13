# Study Day Moodle Block Plugin

The Study Day Moodle block plugin displays a polar chart showing the number of logins per day of the week for the logged-in user. It visualizes login activity to help users track their study days effectively.

## Features

- Polar chart representation of login activity across days of the week.
- Dynamic update based on user's login data.
- Responsive design for seamless integration into Moodle course pages.

## Installation

1. **Download**: Download the `study_day` plugin folder.

2. **Upload**: Upload the `study_day` folder to the `blocks` directory in your Moodle installation: 
3. **Installation via Moodle Interface**:
- Visit your Moodle site's admin area.
- Go to `Site administration` -> `Notifications`.
- Follow the on-screen instructions to install the plugin.

4. **Add Block to Course**:
- Navigate to a Moodle course page where you want to add the Study Day block.
- Turn editing on.
- Locate the "Add a block" section in the sidebar.
- Choose "Study Day" from the list of available blocks.

## Usage

- After adding the Study Day block to a course page:
- The polar chart will automatically display login data for the logged-in user.
- Each segment in the chart represents a day of the week (Monday to Sunday).
- Hover over segments to view exact login counts.
- Chart updates dynamically based on the user's latest login activity.

## Configuration

- **Customization**: Modify `block_study_day.php` to adjust chart appearance or data sources.
- **Localization**: Edit `lang/en/block_study_day.php` to translate strings or add new languages.
- **Styling**: Customize `styles.css` to change block appearance using CSS.

## Contributing

Contributions to the Study Day plugin are welcome! To contribute:
- Fork the repository.
- Create a new branch (`git checkout -b feature/your-feature`).
- Commit your changes (`git commit -am 'Add new feature'`).
- Push to the branch (`git push origin feature/your-feature`).
- Create a new Pull Request.

## License

This plugin is licensed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html).

## Support

For questions, issues, or feedback:
- Contact the plugin maintainer.
- Report issues on [GitHub Issues](link-to-issues).
- Visit the Moodle community forums.


