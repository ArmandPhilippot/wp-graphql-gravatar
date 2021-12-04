# WP GraphQL Gravatar

This plugin adds a WP GraphQL field containing the Gravatar url of the comment author.

## Requirements

-   [WP GraphQL](https://github.com/wp-graphql/wp-graphql)

## Description

This plugin allows you to retrieve the author Gravatar inside your comments. Since WP GraphQL does not expose the author email publicly (by default), the gravatar needs to be fetch earlier. The plugin uses a native WordPress function to get the avatar url and it adds it inside a `gravatarUrl` field.

**Query example:**

```graphql
query SinglePost($slug: String!) {
	articleBy(slug: $slug) {
		id
		title
		date
		content
		comments {
			nodes {
				id
				date
				content
				author {
					node {
						gravatarUrl
						name
						url
					}
				}
			}
		}
	}
}
```

## Installation

Download this repo, then put the plugin inside your `wp-content/plugins/` directory and activate it in your WordPress admin.

## License

This WordPress plugin is open-source and released under the [GPL 2.0 or later license](./LICENSE).
