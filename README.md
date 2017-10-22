# Disqus Notify plugin for Craft CMS 3.x

Notify authors when a comment is added via Disqus.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

1. Then tell Composer to load the plugin:

        composer require viget/craft-disqus-notify

1. In the Control Panel, go to Settings → Plugins and click the “Install” button for Disqus Notify.

## Configuring Disqus Notify

1. Navigate to the plugin settings to customize the email subject and body.

1. Signup for a [Disqus](https://disqus.com/) account and configure for your site.

## Using Disqus Notify

You will utilize the Disqus `onNewComment` callback to make an AJAX request to the Disqus Notify plugin.

You need to pass the following pieces of data to the plugin:

1. Disqus Comment Text
1. Entry ID
1. Entry Author ID

The URL that you need to `POST` to is `{{ actionUrl("disqusNotify/notify/notify") }}`

Here is an example of the plugin in action utilizing jQuery:

```html
<script>
	var disqus_config = function () {
		this.page.identifier = '{{ entry.id }}';

		this.callbacks.onNewComment = [function(comment) {
			var csrfTokenName = "{{ craft.config.get('csrfTokenName') }}";
			var csrfTokenValue = "{{ craft.request.getCsrfToken }}";
			var data = {
				comment: comment.text,
				entryId: {{ entry.id }},
				authorId: {{ entry.author.id }}
			};
			data[csrfTokenName] = csrfTokenValue;

			$.post('{{ actionUrl("disqus-notify/notify/notify") }}', data);
		}];
	};

	(function() {  // DON'T EDIT BELOW THIS LINE
		var d = document, s = d.createElement('script');

		s.src = '//subdomain.disqus.com/embed.js';

		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
	})();
</script>
```

*Note: you will need to update your Disqus subdomain in this code snippet.*
