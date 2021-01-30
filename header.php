<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="sticky">
    <a href="<?php echo bloginfo('url'); ?>" class="logo"> <?php echo bloginfo('name'); ?> </a>
</header>

<p> <?php echo bloginfo('description'); ?> </p>
