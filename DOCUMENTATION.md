<!-- ![verseoftheday](https://laravel-og.beyondco.de/Verse%20of%20the%20Day.png?theme=light&packageManager=composer+require&packageName=michaelmannucci%2Fverseoftheday&pattern=architect&style=style_1&description=Start+your+day+with+the+Word+of+life&md=1&showWatermark=0&fontSize=100px&images=book-open) -->

# Statamic Modifier: Shades

## What is it

A modifier that generates color shades from a given hex color. It can be used with the [color fieldtype](https://www.statamic.dev/fieldtypes/color) or with manual input. It can be used generate [Tailwind CSS color palettes](https://tailwindcss.com/docs/customizing-colors) or to manually generate individual shades and tints.

## How to install it

Install via composer or the Control Panel.

```bash
composer require michaelmannucci/shades
```

## How to use it

*Shades* can be used in two ways: automatically generate Tailwind CSS color palettes, or manually generate tints and/or shades.

### Tailwind CSS palette

You can also automatically generate 10 Tailwind CSS shades and tints to use with Tailwind CSS (eg. bg-yourcolor-500, text-yourcolor-200, etc.). This works by utilizing [CSS `:root`](https://developer.mozilla.org/en-US/docs/Web/CSS/:root) and connecting it to your `tailwind.config.js` file.

The formula is:

```
{{ color | shades:tailwind:name }}
```

- `color` would be the color you want to modify. You can use a color fieldtype, or enter one manually (eg. `#ff269e`.)
- `shades` is the name of the modifier
- `tailwind` lets the modifier know that you intend to use it to generate a Tailwind CSS palette, instead of generating shades or tints manually
- `name` is what you want the custom Tailwind palette to be named (eg. `brand`, `magenta`, etc.) so that it can be used in your templates (eg. `text-brand-500`, `bg-magenta-200`, etc.)

For example, if you wanted to use a **<span style="color:#ff269e">Statamic pink</span>** palette named `statamic` in your templates, you would:

#### 1. Put the following in your `layout.antlers.html` file, right under the `<body>` tag:

```
{{ "#ff269e" | shades:tailwind:statamic }}
```

This will generate the following output:

```
<style>:root{--statamic-50:#ffe9f5;--statamic-100:#ffd4ec;--statamic-200:#ffa8d8;--statamic-300:#ff7dc5;--statamic-400:#ff51b1;--statamic-500:#ff269e;--statamic-600:#cc1e7e;--statamic-700:#99175f;--statamic-800:#660f3f;--statamic-900:#330820;}</style>
```

#### 2. In your `tailwind.config.js` file, add the following:

```
module.exports = {
  theme: {
    extend: {
      colors: {
        'statamic': {
          50: 'var(--statamic-50)',
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

You can now use this color palette in all Tailwind CSS color utilities (eg. `border-statamic-400`, `bg-statamic-900`, etc.).

**Note:** By default, the original color (in this case `#ff269e`) would be `statamic-500`.

### Manual generation

The formula for manual generation of a tint or shade is:

```
{{ color | shades:(tint or shade):percentage }}
```

- `color` would be the color you want to modify. You can use a color fieldtype, or enter one manually (eg. `#01d0aa`.)
- `shades` is the name of the modifier
- `tint` or `shade` lets the modifier know whether you want to make a brighter tint, or a darkers shade
- `percentage` is the degree to which you want to modify the original color

For example, if you wanted to generate a 50% brighter tint of the **<span style="color:#01d0aa">Statamic green</span>** color, you would do:

```
{{ "#01d0aa" | shades:tint:50 }}
```

This would return `#80e8d5`.

Or, if you wanted to generate a 20% darker variant of the **<span style="color:#01d0aa">Statamic green</span>** color, you would do:

```
{{ "#01d0aa" | shades:shade:20 }}
```

This would return `#01a688`