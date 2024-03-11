# HTML mail utility

## What does it do?

Extension _html_mail_utility_ bundles a couple of
third-party libraries which are needed for a HTML newsletter
campaign. Each of them ship with a Fluid view helper or
a Class suitable for `USER` or `USER_INT`.

* [Inky](http://foundation.zurb.com/emails/docs/inky.html) is a
set of tags like `<container>` or `<row>` that will be transformed
 to the beloved stone-age `<table>` markup. This extension makes
 use of the PHP implementation [hampe/inky](https://github.com/thampe/inky)

* CSS inlining is another common task for newsletter mailings.
[tijsverkoyen/css-to-inline-styles](https://github.com/tijsverkoyen/CssToInlineStyles)
is integrated for this purpose.

* For html and plaintext multipart messages,
[html2text/html2text](https://github.com/mtibben/html2text) is bundled
so you can convert HTML to plaintext at the very end of
your newsletter build process.

All three dependencies are decoupled by interfaces. Concrete implementations
can thus be switched by configuration or at runtime.

## Installation

### Composer install

Just require the extension. Dependencies will
be installed automatically.

    composer require undkonsorten/html-mail-utility

### Non-Composer mode

Using without composer ist not supported!

## Fluid ViewHelpers

To start using the ViewHelpers, don‘t forget to include
the corresponding namespace in your template files:

    <html xmlns:m="http://typo3.org/ns/Undkonsorten/HtmlMailUtility/ViewHelpers">

### Inky view helper

    <m:format.inky gridColumns="16" aliases="{bricks:'column'}">

Parameters:

* **markup** (string, optional): You can pass markup in this
attribute. Leave unset to use tag content instead.
* **gridColums** (int, optional): Set this to change the
underlying grid system column calculations are based on. Defaults
to 12.
* **aliases** (array, optional): Aliases allow you to define aliases
for inky tags, e.g. write `<bricks>` instead of `<column>` in
the example above.

Output:

Markup with inky tags transformed to table legacy.


#### Beware of uncached actions!!!

Uncached Action will not be rendered with Inky. The transforming won't work and the complete output of this action won't be shown! You have no output of uncached action!


### CSS Inline view helper

    <m:css.inline cssFile="EXT:my_ext/Resources/Public/Css/Mail.css">

Parameters:

* **html** (string, optional): You can pass HTML markup in this
attribute. Leave unset to use tag content instead.
* **css** (string, optional): Put additional CSS styles here.
* **cssFile** (string, optional): You can specify a CSS file for
inlining. You can use `EXT:` syntax.

Output:

HTML markup with inline `style` attributes according to
matching CSS rules.

### Plain text view helper

    <m:format.plainText>

* **html** (string, optional): You can pass HTML markup in this
attribute. Leave unset to use tag content instead.
* **baseUrl** (string, optional): If set, this value will
be prepended to all on-site links to make them accessible from
plain text. Not needed if your markup ships with absolute links.
