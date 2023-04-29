# Generator for HTTP header fields, status codes and media types

This generator can be used to create PHP classes with constants for HTTP header fields, status codes and media types.

The data source is the JSON output from https://webconcepts.info which provides extensive information about the
underlying concepts including links to specifications of all provided header fields, status codes and media types.

## Installation with Composer
```shell
composer require crypto_scythe/http_generator --dev
```

## Usage

```shell
./vendor/bin/http_generate.php "My\\Wanted\\Namespace" ./src/My/Wanted/Namespace
```

After running the command three files will be created:

- `HeaderFields.php`
- `MediaTypes.php`
- `StatusCodes.php`

Every file contains constants which can be used for convenience and looking up the underlying concepts regarding them.

### Example for `HeaderFields.php`
```php
/**
 * Header field Content-Type
 *
 * The "Content-Type" header field indicates the media type of the associated representation: either the
 * representation enclosed in the message payload or the selected representation, as determined by the message
 * semantics. The indicated media type defines both the data format and how that data is intended to be
 * processed by a recipient, within the scope of the received message semantics, after any content codings
 * indicated by Content-Encoding are decoded.
 *
 * @see https://webconcepts.info/specs/IETF/RFC/7231
 * @see https://datatracker.ietf.org/doc/html/rfc7231#section-3.1.1.5
 */
public const CONTENT_TYPE = 'Content-Type';
```

### Example for `MediaTypes.php`

```php
/**
 * Media type application/json
 *
 * JavaScript Object Notation (JSON) is a text format for the serialization of structured data. It is derived
 * from the object literals of JavaScript, as defined in the ECMAScript Programming Language Standard, Third
 * Edition.
 *
 * @see https://webconcepts.info/specs/IETF/I-D/ietf-jsonbis-rfc7159bis
 * @see https://datatracker.ietf.org/doc/html/draft-ietf-jsonbis-rfc7159bis#section-1
 * 
 * JavaScript Object Notation (JSON) is a text format for the serialization of structured data. It is derived
 * from the object literals of JavaScript, as defined in the ECMAScript Programming Language Standard, Third
 * Edition. JSON can represent four primitive types (strings, numbers, booleans, and null) and two structured
 * types (objects and arrays).
 *
 * @see https://webconcepts.info/specs/IETF/RFC/8259
 * @see https://datatracker.ietf.org/doc/html/rfc8259#section-1
 */
public const APPLICATION_JSON = 'application/json';
```

### Example for `StatusCodes.php`

```php
/**
 * Status 404
 *
 * The 404 (Not Found) status code indicates that the origin server did not find a current representation for
 * the target resource or is not willing to disclose that one exists. A 404 status code does not indicate
 * whether this lack of representation is temporary or permanent; the 410 (Gone) status code is preferred over
 * 404 if the origin server knows, presumably through some configurable means, that the condition is likely to
 * be permanent.
 *
 * @see https://webconcepts.info/specs/IETF/RFC/7231
 * @see https://datatracker.ietf.org/doc/html/rfc7231#section-6.5.4
 */
public const STATUS_404 = 404;
public const MESSAGE_404 = 'Not Found';
public const STATUS_NOT_FOUND = self::STATUS_404;
public const MESSAGE_NOT_FOUND = self::MESSAGE_404;
```