<?php
/* Library Name: Advance Custom Fields v.1.1
 * Function: Add pre-defined advance custom fields to the field groups
 * Date: 08/08/2016
 * Last Modified: 02/21/2017
 * Notes : Added default Hero, Parent Page, Custom CSS (TD)
 * Fields Group added: Page Header Setup, Custom CSS, Parent Page Setup, Custom Subsection, Home page Hero, Site Footer
 * 9/28/2016 Add Site header
 * 2/21/2017 Add Page Related for stores
 * */


function cb_acf_add_local_field_groups() { //hooked into function.php

    $storiesPageID = 24; //stories of change ID

    acf_add_local_field_group(array (
        /* *******************
         * Page setups for hero image left/right or just text banner
         ******************** */
	    'key' => 'group_55e4e268b361c', //unquie key
	    'title' => 'Page Setup',
	    'fields' => array (
		    array (
			    'key' => 'field_55ea87efb1fa4',
			    'label' => 'Header Style',
			    'name' => 'page_header-style',
			    'type' => 'select',
			    'instructions' => '',
			    'required' => 0,
			    'conditional_logic' => 0,
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'choices' => array (
				    'image' => 'Image Banner',
				    'text' => 'Text Banner',
			    ),
			    'default_value' => array (
				    'text' => 'text',
			    ),
			    'allow_null' => 0,
			    'multiple' => 0,
			    'ui' => 0,
			    'ajax' => 0,
			    'placeholder' => '',
			    'disabled' => 0,
			    'readonly' => 0,
		    ),
		    array (
			    'key' => 'field_55ea8784b1fa3',
			    'label' => 'Content Display Mode',
			    'name' => 'page_banner-size',
			    'type' => 'select',
			    'instructions' => 'Choose position would you like the image to display',
			    'required' => 0,
			    'conditional_logic' => array (
				    array (
					    array (
						    'field' => 'field_55ea87efb1fa4',
						    'operator' => '==',
						    'value' => 'image',
					    ),
				    ),
			    ),
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'choices' => array (
				    'left' => 'Left',
				    'right' => 'Right',
                    //'full' => 'Full',
			    ),
			    'default_value' => array (
				    0 => 'left',
			    ),
			    'allow_null' => 0,
			    'multiple' => 0,
			    'ui' => 0,
			    'ajax' => 0,
			    'placeholder' => '',
			    'disabled' => 0,
			    'readonly' => 0,
		    ),
		    array (
			    'key' => 'field_55e4e268bfb9e',
			    'label' => 'Header Summary',
			    'name' => 'page_header-text',
			    'type' => 'text',
			    'instructions' => 'The block of text that appears next to the page title at the top of the page. Leave this blank to have the allow the page title to span across the entire header.',
			    'required' => 0,
			    'conditional_logic' => array (
				    array (
					    array (
						    'field' => 'field_55ea87efb1fa4',
						    'operator' => '==',
						    'value' => 'image',
					    ),
					    array (
						    'field' => 'field_55ea8784b1fa3',
						    'operator' => '==',
						    'value' => 'left',
					    ),
				    ),
				    /* array (
					    array (
						    'field' => 'field_55ea87efb1fa4',
						    'operator' => '==',
						    'value' => 'text',
					    ),
				    ), */
				    array (
					    array (
						    'field' => 'field_55ea87efb1fa4',
						    'operator' => '==',
						    'value' => 'image',
					    ),
					    array (
						    'field' => 'field_55ea8784b1fa3',
						    'operator' => '==',
						    'value' => 'right',
					    ),
				    ),
			    ),
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'default_value' => '',
			    'placeholder' => '',
			    'prepend' => '',
			    'append' => '',
			    'maxlength' => 500,
			    'readonly' => 0,
			    'disabled' => 0,
		    ),
		    array (
			    'key' => 'field_55ea88a9b1fa5',
			    'label' => 'Image',
			    'name' => 'hero_background-image-url',
			    'type' => 'image',
			    'instructions' => '',
			    'required' => 0,
			    'conditional_logic' => array (
				    array (
					    array (
						    'field' => 'field_55ea87efb1fa4',
						    'operator' => '==',
						    'value' => 'image',
					    ),
				    ),
			    ),
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'return_format' => 'array',
			    'preview_size' => 'grid-page-hero-thumbnail',
			    'library' => 'all',
			    'min_width' => 535,
			    'min_height' => 320,
			    'min_size' => '',
			    'max_width' => '',
			    'max_height' => '',
			    'max_size' => '',
			    'mime_types' => '',
		    ),
		    array (
			    'key' => 'field_55ea8c59b1faa',
			    'label' => 'Title Override',
			    'name' => 'page_title-override',
			    'type' => 'true_false',
			    'instructions' => 'Override the default page title?',
			    'required' => 0,
			    'conditional_logic' => 0,
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'message' => '',
			    'default_value' => 0,
		    ),
		    array (
			    'key' => 'field_55ea8caab1fab',
			    'label' => 'New Title',
			    'name' => 'page_header-title',
			    'type' => 'text',
			    'instructions' => '',
			    'required' => 0,
			    'conditional_logic' => array (
				    array (
					    array (
						    'field' => 'field_55ea8c59b1faa',
						    'operator' => '==',
						    'value' => '1',
					    ),
				    ),
			    ),
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'default_value' => '',
			    'placeholder' => '',
			    'prepend' => '',
			    'append' => '',
			    'maxlength' => 250,
			    'readonly' => 0,
			    'disabled' => 0,
		    ),
	    ),
	    'location' => array (
               array (
			    array (
				    'param' => 'post_type',
				    'operator' => '!=',
				    'value' => 'staff_member',
			    ),
			    array (
				    'param' => 'page_type',
				    'operator' => '!=',
				    'value' => 'front_page',
			    ),
		    ),
	    ),
	    'menu_order' => 0,
	    'position' => 'acf_after_title',
	    'style' => 'default',
	    'label_placement' => 'top',
	    'instruction_placement' => 'label',
	    'hide_on_screen' => '',
	    'active' => 1,
	    'description' => '',
    ));
    /* *******************
     * EOF PAGE SETUP
     ******************** */
    /* *******************
     *  Site Header
     ******************** */
    acf_add_local_field_group(array (
    'key' => 'group_5585db0a912c8',
    'title' => 'Site - Header',
    'fields' => array (
        array (
            'key' => 'field_5585db9ce68dc',
            'label' => 'Logo',
            'name' => 'header_logo',
            'type' => 'image',
            'instructions' => 'The site logo image that appears in the top corner of the page.',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'thumbnail',
            'library' => 'all',
            'min_width' => 162,
            'min_height' => 50,
            'min_size' => '',
            'max_width' => 600,
            'max_height' => 200,
            'max_size' => '',
            'mime_types' => '',
        ),
        array (
            'key' => 'field_55c4e3ceb9069',
            'label' => 'Donate Button Text',
            'name' => 'header_donate-button-text',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 'Donate Now',
            'placeholder' => 'Donate Now',
            'prepend' => '',
            'append' => '',
            'maxlength' => 100,
            'readonly' => 0,
            'disabled' => 0,
        ),
        array (
            'key' => 'field_55c4e402b906a',
            'label' => 'Donate Button Url',
            'name' => 'header_donate-button-url',
            'type' => 'url',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
        ),
        array (
            'key' => 'field_donateMonthly',
            'label' => 'Donate Monthly Url',
            'name' => 'header_donate-monthly-url',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
        ),
         array (
            'key' => 'field_donateSingle',
            'label' => 'Donate Single Url',
            'name' => 'header_donate-single-url',
            'type' => 'url',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-header',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
    /* *******************
     * EOF Site Header
     ******************** */

    /* *******************
     * Custom CSS Overrides
     ******************** */
    acf_add_local_field_group(array (
    'key' => 'group_custom_css_override',
    'title' => 'Custom CSS Style Overrides',
    'fields' => array (
        array (
            'key' => 'field_custom_css_1',
            'label' => 'Custom CSS',
            'name' => 'custom_css',
            'type' => 'textarea',
            'instructions' => 'This area is used for any custom css style',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => '',
            'new_lines' => '',
            'readonly' => 0,
            'disabled' => 0,
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-general-settings',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
    /* ************************
     * EOF Custom CSS Overrides
     *************************** */

    /* ************************
     * Parent Page setup
     *************************** */
    acf_add_local_field_group(array (
	    'key' => 'group_parent_page_setup',
	    'title' => 'Parent Setup',
	    'fields' => array (
		    array (
			    'key' => 'field_parent_page-1',
			    'label' => 'Page Summary',
			    'name' => 'page_summary',
			    'type' => 'textarea',
			    'instructions' => 'The summary text excerpt that appears beside the image on the parent page',
			    'required' => 0,
			    'conditional_logic' => 0,
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'default_value' => '',
			    'tabs' => 'text',
			    'toolbar' => 'basic',
			    'media_upload' => 0,
		    ),
		    array (
			    'key' => 'field_parent_page-2',
			    'label' => 'Call to Action',
			    'name' => 'page_call-to-action',
			    'type' => 'text',
			    'instructions' => 'Enter the text on the link that leads you to this page from it\'s parent page, or clear the field to remove the link altogether.',
			    'required' => 0,
			    'conditional_logic' => 0,
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'default_value' => 'Learn More',
			    'placeholder' => '',
			    'prepend' => '',
			    'append' => '',
			    'maxlength' => 100,
			    'readonly' => 0,
			    'disabled' => 0,
		    ),
		    array (
			    'key' => 'field_parent_page-3',
			    'label' => 'Show in Parent List?',
			    'name' => 'page_show-in-parent-list',
			    'type' => 'true_false',
			    'instructions' => 'Include this page in the parent page\'s list?',
			    'required' => 0,
			    'conditional_logic' => 0,
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'message' => '',
			    'default_value' => 1,
		    ),
	    ),
	    'location' => array (
		    array (
			    array (
				    'param' => 'post_type',
				    'operator' => '==',
				    'value' => 'page',
			    ),
                 array (
				'param' => 'page_type',
				'operator' => '!=',
				'value' => 'front_page',
			    ),
			    array (
				    'param' => 'page_type',
				    'operator' => '==',
				    'value' => 'child',
			    ),
		    ),
		    array (
			    array (
				    'param' => 'post_type',
				    'operator' => '==',
				    'value' => 'post',
			    ),
		    ),
	    ),
	    'menu_order' => 1,
	    'position' => 'normal',
	    'style' => 'default',
	    'label_placement' => 'left',
	    'instruction_placement' => 'label',
	    'hide_on_screen' => array (
		    0 => 'excerpt',
	    ),
	    'active' => 1,
	    'description' => '',
    ));
    /* ************************
     * EOF Parent Page Setup
     *************************** */

    /* ************************
     * Custom Subsection
     *************************** */

    acf_add_local_field_group(array (
	    'key' => 'group_55ba453876528',
	    'title' => 'Sub Sections',
	    'fields' => array (
		    array (
			    'key' => 'field_55ba465677634',
			    'label' => 'Source',
			    'name' => 'subsection_source',
			    'type' => 'select',
			    'instructions' => 'Where should this page get the data to display?',
			    'required' => 1,
			    'conditional_logic' => 0,
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'choices' => array (
				    'children' => 'Show all active child pages',
				    'custom' => 'Create custom',
			    ),
			    'default_value' => array (
				    'children' => 'children',
			    ),
			    'allow_null' => 0,
			    'multiple' => 0,
			    'ui' => 0,
			    'ajax' => 0,
			    'placeholder' => '',
			    'disabled' => 0,
			    'readonly' => 0,
		    ),
		    array (
			    'key' => 'field_55ba474077635',
			    'label' => 'Custom Sections',
			    'name' => 'subsection_custom-sections',
			    'type' => 'repeater',
			    'instructions' => 'Add a custom section to the page',
			    'required' => 0,
			    'conditional_logic' => array (
				    array (
					    array (
						    'field' => 'field_55ba465677634',
						    'operator' => '==',
						    'value' => 'custom',
					    ),
				    ),
			    ),
			    'wrapper' => array (
				    'width' => '',
				    'class' => '',
				    'id' => '',
			    ),
			    'min' => '',
			    'max' => '',
			    'layout' => 'row',
			    'button_label' => 'Add Section',
			    'sub_fields' => array (
				    array (
					    'key' => 'field_55ba481477636',
					    'label' => 'Type',
					    'name' => 'subsection_type',
					    'type' => 'select',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => 0,
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'choices' => array (
						    'custom' => 'Custom',
						    'page' => 'Page',
						    'category' => 'Category',
					    ),
					    'default_value' => array (
						    'custom' => 'custom',
					    ),
					    'allow_null' => 0,
					    'multiple' => 0,
					    'ui' => 0,
					    'ajax' => 0,
					    'placeholder' => '',
					    'disabled' => 0,
					    'readonly' => 0,
				    ),
				    array (
					    'key' => 'field_55ba498777637',
					    'label' => 'Page',
					    'name' => 'subsection_page',
					    'type' => 'post_object',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => array (
						    array (
							    array (
								    'field' => 'field_55ba481477636',
								    'operator' => '==',
								    'value' => 'page',
							    ),
						    ),
					    ),
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'post_type' => array (
						    0 => 'page',
						    1 => 'post',
					    ),
					    'taxonomy' => array (
					    ),
					    'allow_null' => 0,
					    'multiple' => 0,
					    'return_format' => 'object',
					    'ui' => 1,
				    ),
				    array (
					    'key' => 'field_55ba4a1077638',
					    'label' => 'Category',
					    'name' => 'subsection_category',
					    'type' => 'taxonomy',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => array (
						    array (
							    array (
								    'field' => 'field_55ba481477636',
								    'operator' => '==',
								    'value' => 'category',
							    ),
						    ),
					    ),
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'taxonomy' => 'category',
					    'field_type' => 'multi_select',
					    'allow_null' => 0,
					    'add_term' => 0,
					    'load_save_terms' => 0,
					    'return_format' => 'object',
					    'multiple' => 0,
					    'load_terms' => 0,
					    'save_terms' => 0,
				    ),
				    array (
					    'key' => 'field_55ba4a8077639',
					    'label' => 'Header Copy',
					    'name' => 'subsection_header-copy',
					    'type' => 'text',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => array (
						    array (
							    array (
								    'field' => 'field_55ba481477636',
								    'operator' => '==',
								    'value' => 'custom',
							    ),
						    ),
					    ),
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'default_value' => '',
					    'placeholder' => '',
					    'prepend' => '',
					    'append' => '',
					    'maxlength' => 1500,
					    'readonly' => 0,
					    'disabled' => 0,
				    ),
				    array (
					    'key' => 'field_55ba4afb7763a',
					    'label' => 'Image',
					    'name' => 'subsection_image',
					    'type' => 'image',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => array (
						    array (
							    array (
								    'field' => 'field_55ba481477636',
								    'operator' => '==',
								    'value' => 'custom',
							    ),
						    ),
					    ),
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'return_format' => 'array',
					    'preview_size' => 'list-page-thumbnail',
					    'library' => 'all',
					    'min_width' => 150,
					    'min_height' => 150,
					    'min_size' => '',
					    'max_width' => '',
					    'max_height' => '',
					    'max_size' => '',
					    'mime_types' => '',
				    ),
				    array (
					    'key' => 'field_55ba4bc07763b',
					    'label' => 'Summary',
					    'name' => 'subsection_summary',
					    'type' => 'wysiwyg',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => array (
						    array (
							    array (
								    'field' => 'field_55ba481477636',
								    'operator' => '==',
								    'value' => 'custom',
							    ),
						    ),
					    ),
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'default_value' => '',
					    'tabs' => 'all',
					    'toolbar' => 'full',
					    'media_upload' => 1,
				    ),
				    array (
					    'key' => 'field_55ba4c327763c',
					    'label' => 'Link Copy',
					    'name' => 'subsection_link-copy',
					    'type' => 'text',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => array (
						    array (
							    array (
								    'field' => 'field_55ba481477636',
								    'operator' => '==',
								    'value' => 'custom',
							    ),
						    ),
					    ),
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'default_value' => '',
					    'placeholder' => 'Read More',
					    'prepend' => '',
					    'append' => '',
					    'maxlength' => 120,
					    'readonly' => 0,
					    'disabled' => 0,
				    ),
				    array (
					    'key' => 'field_55ba4c837763d',
					    'label' => 'Link Url',
					    'name' => 'subsection_link-url',
					    'type' => 'url',
					    'instructions' => '',
					    'required' => 0,
					    'conditional_logic' => array (
						    array (
							    array (
								    'field' => 'field_55ba481477636',
								    'operator' => '==',
								    'value' => 'custom',
							    ),
						    ),
					    ),
					    'wrapper' => array (
						    'width' => '',
						    'class' => '',
						    'id' => '',
					    ),
					    'default_value' => '',
					    'placeholder' => 'http://www.example.com/',
				    ),
			    ),
		    ),
	    ),
	    'location' => array (
		    array (
			    array (
				    'param' => 'page_template',
				    'operator' => '==',
				    'value' => 'templates/list-grid.php',
			    ),
		    ),
		    array (
			    array (
				    'param' => 'page_template',
				    'operator' => '==',
				    'value' => 'templates/list-hero.php',
			    ),
		    ),
		    array (
			    array (
				    'param' => 'page_template',
				    'operator' => '==',
				    'value' => 'templates/list.php',
			    ),
		    ),
             array (
			    array (
				    'param' => 'page_template',
				    'operator' => '==',
				    'value' => 'templates/hunger-action.php',
			    ),
		    ),
	    ),
	    'menu_order' => 2,
	    'position' => 'normal',
	    'style' => 'default',
	    'label_placement' => 'top',
	    'instruction_placement' => 'label',
	    'hide_on_screen' => '',
	    'active' => 1,
	    'description' => '',
    ));
    /* ************************
     * EOF Subsection
     *************************** */


    /* ************************
     * Homepage HERO AREA
     *************************** */

    acf_add_local_field_group(array (
     'key' => 'group_5581b80b4bf92',
     'title' => 'Home - Hero Area #1',
     'fields' => array (
         array (
             'key' => 'field_55b7c9f3b5717',
             'label' => 'Content Display Mode',
             'name' => 'hero_content-display-mode:1',
             'type' => 'select',
             'instructions' => 'How should the copy content appear relative to the hero image?
',
             'required' => 1,
             'conditional_logic' => 0,
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'choices' => array (
                 'right' => 'Right of the image',
                 'left' => 'Left of the image',
                 'full' => 'Over the image',
                 'video' => 'Over the video',
             ),
             'default_value' => array (
                 0 => 'video',
             ),
             'allow_null' => 0,
             'multiple' => 0,
             'ui' => 0,
             'ajax' => 0,
             'placeholder' => '',
             'disabled' => 0,
             'readonly' => 0,
         ),
         array (
             'key' => 'field_5580ba3aa2ae4',
             'label' => 'Hero Image',
             'name' => 'hero_background-image-url:1',
             'type' => 'image',
             'instructions' => '',
             'required' => 0,
             'conditional_logic' => 0,
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'return_format' => 'array',
             'preview_size' => 'home-hero-banner',
             'library' => 'all',
             'min_width' => 676,
             'min_height' => 450,
             'min_size' => '',
             'max_width' => '',
             'max_height' => '',
             'max_size' => '',
             'mime_types' => '',
         ),
         array (
             'key' => 'field_581cfdb542754',
             'label' => 'Video Poster Image',
             'name' => 'hero_video-poster-image:1',
             'type' => 'image',
             'instructions' => 'This image will appear while the video is downloading.	If no image is specified, the first frame of the video will be used.',
             'required' => 0,
             'conditional_logic' => array (
                 array (
                     array (
                         'field' => 'field_55b7c9f3b5717',
                         'operator' => '==',
                         'value' => 'video',
                     ),
                 ),
             ),
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'return_format' => 'array',
             'preview_size' => 'home-hero-banner',
             'library' => 'all',
             'min_width' => 676,
             'min_height' => 450,
             'min_size' => '',
             'max_width' => '',
             'max_height' => '',
             'max_size' => '',
             'mime_types' => '',
         ),
         array (
             'key' => 'field_57f3e14c64eed',
             'label' => 'Hero Video',
             'name' => 'hero_video-files:1',
             'type' => 'repeater',
             'instructions' => 'Add mp4, webm and/or ogg files of your hero video',
             'required' => 0,
             'conditional_logic' => array (
                 array (
                     array (
                         'field' => 'field_55b7c9f3b5717',
                         'operator' => '==',
                         'value' => 'video',
                     ),
                 ),
             ),
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'collapsed' => '',
             'min' => '',
             'max' => '',
             'layout' => 'row',
             'button_label' => 'Add Video',
             'sub_fields' => array (
                 array (
                     'key' => 'field_57f3e48cfbcb1',
                     'label' => 'File Location',
                     'name' => 'file_location',
                     'type' => 'select',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => 0,
                     'wrapper' => array (
                         'width' => '',
                         'class' => '',
                         'id' => '',
                     ),
                     'choices' => array (
                         'local' => 'Upload file to your website',
                         'remote' => 'Specify a remote URL',
                     ),
                     'default_value' => array (
                         0 => 'local',
                     ),
                     'allow_null' => 0,
                     'multiple' => 0,
                     'ui' => 0,
                     'ajax' => 0,
                     'placeholder' => '',
                     'disabled' => 0,
                     'readonly' => 0,
                 ),
                 array (
                     'key' => 'field_57f3e421fbcb0',
                     'label' => 'Video File',
                     'name' => 'video_url',
                     'type' => 'file',
                     'instructions' => 'Upload a mp4, webm, or ogg video file',
                     'required' => 0,
                     'conditional_logic' => array (
                         array (
                             array (
                                 'field' => 'field_57f3e48cfbcb1',
                                 'operator' => '==',
                                 'value' => 'local',
                             ),
                         ),
                     ),
                     'wrapper' => array (
                         'width' => '',
                         'class' => '',
                         'id' => '',
                     ),
                     'return_format' => 'array',
                     'library' => 'all',
                     'min_size' => '',
                     'max_size' => 100,
                     'mime_types' => 'mp4, webm, ogg',
                 ),
                 array (
                     'key' => 'field_57f3e4f4fbcb2',
                     'label' => 'Video Url',
                     'name' => 'video_url',
                     'type' => 'url',
                     'instructions' => '',
                     'required' => 0,
                     'conditional_logic' => array (
                         array (
                             array (
                                 'field' => 'field_57f3e48cfbcb1',
                                 'operator' => '==',
                                 'value' => 'remote',
                             ),
                         ),
                     ),
                     'wrapper' => array (
                         'width' => '',
                         'class' => '',
                         'id' => '',
                     ),
                     'default_value' => '',
                     'placeholder' => 'https://www.example.com/video.mp4',
                 ),
             ),
         ),
         array (
             'key' => 'field_5825fed4feab2',
             'label' => 'Video Display Mode',
             'name' => 'hero_video-display-mode:1',
             'type' => 'select',
             'instructions' => 'Select from one of 3 options: Cover, Contain or Overflow',
             'required' => 0,
             'conditional_logic' => array (
                 array (
                     array (
                         'field' => 'field_55b7c9f3b5717',
                         'operator' => '==',
                         'value' => 'video',
                     ),
                 ),
             ),
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'choices' => array (
                 'contain' => 'Contain - The video will always be completely contained within the "fold"',
                 'cover' => 'Cover - The video will scale to fill the entire viewable area above the "fold" with the top and bottom cropped.',
                 'overflow' => 'Overflow - The video will scale to fill the width of the viewable area but will also extend below the "fold"',
             ),
             'default_value' => array (
                 0 => 'cover',
             ),
             'allow_null' => 0,
             'multiple' => 0,
             'ui' => 0,
             'ajax' => 0,
             'placeholder' => '',
             'disabled' => 0,
             'readonly' => 0,
         ),
         array (
             'key' => 'field_5580ba84a2ae5',
             'label' => 'Headline copy',
             'name' => 'hero_headline-copy:1',
             'type' => 'text',
             'instructions' => '',
             'required' => 0,
             'conditional_logic' => 0,
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'default_value' => '',
             'placeholder' => 'Headline',
             'prepend' => '',
             'append' => '',
             'maxlength' => 100,
             'readonly' => 0,
             'disabled' => 0,
         ),
         array (
             'key' => 'field_5580babca2ae6',
             'label' => 'Headline sub copy',
             'name' => 'hero_headline-sub-copy:1',
             'type' => 'textarea',
             'instructions' => '',
             'required' => 0,
             'conditional_logic' => 0,
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'default_value' => '',
             'placeholder' => '',
             'maxlength' => 1000,
             'rows' => 2,
             'new_lines' => 'br',
             'readonly' => 0,
             'disabled' => 0,
         ),
         array (
             'key' => 'field_5580b94ba2ae3',
             'label' => 'Call to Action Copy',
             'name' => 'hero_donate-button-label:1',
             'type' => 'text',
             'instructions' => 'Enter a value here if you want a "Donate" call to action to appear at the end of the copy',
             'required' => 0,
             'conditional_logic' => 0,
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'default_value' => '',
             'placeholder' => 'Donate Now',
             'prepend' => '',
             'append' => '',
             'maxlength' => 40,
             'readonly' => 0,
             'disabled' => 0,
         ),
         array (
             'key' => 'field_55c4d75585b31',
             'label' => 'Call to Action Page',
             'name' => 'hero_call-to-action-url:1',
             'type' => 'url',
             'instructions' => '',
             'required' => 0,
             'conditional_logic' => 0,
             'wrapper' => array (
                 'width' => '',
                 'class' => '',
                 'id' => '',
             ),
             'post_type' => array (
                 0 => 'page',
             ),
             'taxonomy' => array (
             ),
             'allow_null' => 0,
             'multiple' => 0,
         ),
         array (
             'key' => 'field_55b7c961b5716',
             'label' => 'Content Percentage',
             'name' => 'hero_content-percentage:1',
             'type' => 'number',
             'instructions' => 'What percentage of the area should be dedicated to the copy content, as opposed to the background image?',
             'required' => 1,
             'conditional_logic' => array (
                 array (
                     array (
                         'field' => 'field_55b7c9f3b5717',
                         'operator' => '==',
                         'value' => 'right',
                     ),
                 ),
                 array (
                     array (
                         'field' => 'field_55b7c9f3b5717',
                         'operator' => '==',
                         'value' => 'left',
                     ),
                 ),
             ),
             'wrapper' => array (
                 'width' => 50,
                 'class' => '',
                 'id' => '',
             ),
             'default_value' => 42,
             'placeholder' => 50,
             'prepend' => '',
             'append' => '%',
             'min' => 25,
             'max' => 75,
             'step' => 1,
             'readonly' => 0,
             'disabled' => 0,
         ),
     ),
     'location' => array (
         array (
             array (
                 'param' => 'page_template',
                 'operator' => '==',
                 'value' => 'front-page.php',
             ),
         ),
         array (
             array (
                 'param' => 'page_type',
                 'operator' => '==',
                 'value' => 'front_page',
             ),
         ),
     ),
     'menu_order' => 1,
     'position' => 'acf_after_title',
     'style' => 'default',
     'label_placement' => 'left',
     'instruction_placement' => 'label',
     'hide_on_screen' => array (
         0 => 'the_content',
         1 => 'excerpt',
         2 => 'custom_fields',
         3 => 'discussion',
         4 => 'comments',
         5 => 'revisions',
         6 => 'slug',
         7 => 'author',
         8 => 'format',
         9 => 'featured_image',
         10 => 'categories',
     ),
     'active' => 1,
     'description' => '',
 ));


    /* ************************
     * EOF Home Hero Area
     *************************** */

    /* ************************
     * SITE FOOTER
     *************************** */

    acf_add_local_field_group(array (
	'key' => 'group_55b7c22203944',
	'title' => 'Site - Footer',
	'fields' => array (
		array (
			'key' => 'field_57f59002afd22',
			'label' => 'Donate',
			'name' => 'footer_item-1',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_57c76af679e9b',
			'label' => 'Address',
			'name' => 'footer_item-2',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 0,
		),
		array (
			'key' => 'field_57c76b6d79e9e',
			'label' => 'Learn',
			'name' => 'footer_item-3',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_57f590c2afd23',
			'label' => 'Our Impact',
			'name' => 'footer_item-4',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_57c76ba879ea0',
			'label' => 'Get Involved',
			'name' => 'footer_item-5',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_57c76b3679e9d',
			'label' => 'Follow Us On',
			'name' => 'footer_item-6',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_57c76b1879e9c',
			'label' => '503(c)(3) Message',
			'name' => 'footer_item-7',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 1000,
			'readonly' => 0,
			'disabled' => 0,
		),
        array (
			'key' => 'field_logos_assoication',
			'label' => 'Logos',
			'name' => 'footer_item-8',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),

	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-footer',
			),
		),
	),
	'menu_order' => 15,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));


    /* ************************
     * EOF SITE FOOTER
     *************************** */

    /* ************************
     * PAGE RELATED
     *************************** */
    acf_add_local_field_group(array (
	'key' => 'group_57ec219e9bbf7',
	'title' => 'Page Related',
	'fields' => array (
		array (
			'key' => 'field_57ec21c0dae53',
			'label' => 'Show Related Pages',
			'name' => 'show_related',
			'type' => 'true_false',
			'instructions' => 'Would you like to show related pages',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_parent',
				'operator' => '==',
				'value' => $storiesPageID,
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
    /* ************************
     * EOF PAGE RELATED
     *************************** */

} // end of function

?>