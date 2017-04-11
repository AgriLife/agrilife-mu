## Description

This plugin provides functionality useful for all AgriLife websites.

## Features

1. Images added through content editors will have the protocol removed from their URL
2. In the Network dashboard under Sites is a Search and Replace menu item, which will provide a set of SQL instructions for performing a one-time removal of protocols from image URLs in page and post content.
3. In wp-config.php, you can define a boolean constant named AMU_SECUREPROTOCOL to determine if images should have a secure or unsecure URL protocol. A value of true will make the protocol https, false will make it http.

## WordPress Requirements

None

## Development Requirements

To update a site's posts to use protocol-relative URLs, run the following wp-cli commands:
wp search-replace 'src="http://' 'src="//' 'wp_*posts' --network --include-columns='post_content'
wp search-replace 'src="https://' 'src="//' 'wp_*posts' --network --include-columns='post_content'
wp cache flush
