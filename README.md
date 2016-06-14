prometheus
==========

Front-end foundation for WordPress projects including a page template to view all your styles on one go.

## Installation

### 1) Adding it to your theme

Add this repository to your theme by submoduling it in.

```
git submodule add git@github.com:9thcirclegames/prometheus.git
```

### 2) LESS

This provides a base foundation for styling, including normalize, mixins, etc. Can be included at the top of your master LESS stylesheets:

```css
@import 'prometheus/prometheus.less' 
```

### 3) Tools

To pull in wp-less and other tools, you can include this line near the top of your `functions.php`

```php
require_once( 'prometheus/prometheus.php' );
```
