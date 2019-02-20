# Konstruct Test

A simple wordpress plugin that adds two shortcodes, [test] which outputs 'TEST SUCCEEDED' as a string and [instafeed] which outputs 5 of the most recent pictures from the users instagram account.

The plugin includes an admin page where the user can authorize the plugin to access their data.

## Bugs

The plugin only supports a single users account currently. To switch accounts unfortunately you must uninstall the plugin and reinstall it.

## Possible future features

- Customizable Css and numbers of pictures would not be difficult to implement and could be arguments passed into the shortcode.
- Accessing instagram's graph API.
- Multiple users and a more fleshed out settings screen.
- Refactoring the functional shortcode to be a class based widget.
