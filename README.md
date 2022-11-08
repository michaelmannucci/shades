<!-- ![verseoftheday](https://laravel-og.beyondco.de/Verse%20of%20the%20Day.png?theme=light&packageManager=composer+require&packageName=michaelmannucci%2Fverseoftheday&pattern=architect&style=style_1&description=Start+your+day+with+the+Word+of+life&md=1&showWatermark=0&fontSize=100px&images=book-open) -->

# Statamic Addon: Shades

## What is it

A modifier that generates color shades from a given hex color. Can be used manually or to generate tailwind variants.

## How to install it

Install via composer or the Control Panel

```bash
composer require michaelmannucci/shades
```

## How to use it

Shades can be used in two ways: manually generate tints and/or shades, or automatically generate Tailwind variants.

### Manual generation

The formula for manual generation of a tint or shade is:

```
{{ color | shades:(tint or shade):percentage }}
```

For example, if you wanted to generate a 50% brighter variant of the Statamic pink color, you would do:

```
{{ "#ff269e" | shades:tint:50 }}
```

This would return `#ff93cf`.

Or, if you wanted to generate a 20% darker variant of the Statamic green color, you would do:

```
{{ "#01d7b0" | shades:shade:20 }}
```

This would return `#01ac8d`.

You can also use a color field tag:

```
{{ your_color | shades:tint:87 }}
```

### Tailwind CSS variants

You can also automatically generate 10 Tailwind shades to use with Tailwind CSS (eg. bg-yourcolor-500, text-yourcolor-200, etc.). This works by utilizing a CSS `:root` selector and connecting it to your `tailwind.config.js` file.

The formula is:

```
{{ color | shades:tailwind:name }}
```

For example, if you wanted to use Statamic pink variants in your templates, you would do the following steps:

#### 1. Put the following in your `layout.antlers.html` file, right under the `<body>` tag:

```
{{ "#ff269e" | shades:tailwind:statamic }}
```

This will generate the following output:

```
<style>:root{--statamic-100: #cce3df;--statamic-200: #99c6be;--statamic-300: #66aa9e;--statamic-400: #338d7d;--statamic-500: #00715d;--statamic-600: #005a4a;--statamic-700: #004438;--statamic-800: #002d25;--statamic-900: #001713;}</style>
```

#### 2. In your `tailwind.config.js` file, add the following:

```
module.exports = {
  theme: {
    extend: {
      colors: {
        'statamic': {
          100: 'var(--statamic-100)',
          200: 'var(--statamic-200)',
          300: 'var(--statamic-300)',
          400: 'var(--statamic-400)',
          500: 'var(--statamic-500)',
          600: 'var(--statamic-600)',
          700: 'var(--statamic-700)',
          800: 'var(--statamic-800)',
          900: 'var(--statamic-900)',
        },
      }
    },
  },
}
```

You can now use your color in all Tailwind color utilities (eg. `border-statamic-400`, `bg-statamic-900`, etc.).

**Note:** By default the original color, in this case `#ff269e`, would be `statamic-500`.