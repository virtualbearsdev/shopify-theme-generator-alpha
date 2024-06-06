<?php
// Function to create directories if they don't exist
function createDirectory($path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

// Function to add files and directories to the ZIP archive
function addFilesToZip($dir, &$zip, $base_path) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $file_path = $dir . '/' . $file;
            if (is_dir($file_path)) {
                // Add directory itself
                $relativePath = substr($file_path, strlen($base_path) + 1) . '/';
                $zip->addEmptyDir($relativePath);
                addFilesToZip($file_path, $zip, $base_path);
            } else {
                $relativePath = substr($file_path, strlen($base_path) + 1);
                $zip->addFile($file_path, $relativePath);
            }
        }
    }
}

// Base path for the theme // kelangan pa empty pagkatapos gumawa ng theme
// kelangan din isave yung mga details na galing sa frontend
$theme_base_path = __DIR__ . '/themes/theme-base';

// Ensure the base path exists
createDirectory($theme_base_path);

// Define the theme structure
$theme_structure = [
    'assets',
    'config',
    'layout',
    'locales',
    'sections',
    'snippets',
    'templates',
];

// Create the theme directories and add a .keep file
foreach ($theme_structure as $directory) {
    $dir_path = $theme_base_path . '/' . $directory;
    createDirectory($dir_path);
    // Add a .keep file to each directory
    file_put_contents($dir_path . '/.keep', '');
}

// Define the content for the theme files
$theme_files = [

    'config/settings_data.json' => <<<EOD
    {
        "current": {
            "logo_width": 200,
            "colors_solid_button_labels": "#ffffff",
            "colors_accent_1": "#121212",
            "gradient_accent_1": "",
            "colors_accent_2": "#000000",
            "gradient_accent_2": "",
            "colors_text": "#121212",
            "colors_outline_button_labels": "#000000",
            "colors_background_1": "#ffffff",
            "gradient_background_1": "",
            "colors_background_2": "#f3f3f3",
            "gradient_background_2": "",
            "you_save_color": "#f20f0f",
            "type_header_font": "montserrat_n4",
            "heading_scale": 100,
            "type_body_font": "montserrat_n4",
            "body_scale": 100,
            "page_width": 1200,
            "spacing_sections": 0,
            "spacing_grid_horizontal": 16,
            "spacing_grid_vertical": 16,
            "buttons_border_thickness": 1,
            "buttons_border_opacity": 100,
            "buttons_radius": 0,
            "buttons_shadow_opacity": 0,
            "buttons_shadow_horizontal_offset": 0,
            "buttons_shadow_vertical_offset": 4,
            "buttons_shadow_blur": 5,
            "variant_pills_border_thickness": 1,
            "variant_pills_border_opacity": 55,
            "variant_pills_radius": 40,
            "variant_pills_shadow_opacity": 0,
            "variant_pills_shadow_horizontal_offset": 0,
            "variant_pills_shadow_vertical_offset": 4,
            "variant_pills_shadow_blur": 5,
            "inputs_border_thickness": 1,
            "inputs_border_opacity": 55,
            "inputs_radius": 0,
            "inputs_shadow_opacity": 0,
            "inputs_shadow_horizontal_offset": 0,
            "inputs_shadow_vertical_offset": 4,
            "inputs_shadow_blur": 5,
            "card_style": "card",
            "card_image_padding": 0,
            "card_text_alignment": "left",
            "card_color_scheme": "background-2",
            "card_border_thickness": 0,
            "card_border_opacity": 10,
            "card_corner_radius": 0,
            "card_shadow_opacity": 0,
            "card_shadow_horizontal_offset": 0,
            "card_shadow_vertical_offset": 4,
            "card_shadow_blur": 5,
            "collection_card_style": "card",
            "collection_card_image_padding": 0,
            "collection_card_text_alignment": "center",
            "collection_card_color_scheme": "background-2",
            "collection_card_border_thickness": 0,
            "collection_card_border_opacity": 10,
            "collection_card_corner_radius": 0,
            "collection_card_shadow_opacity": 0,
            "collection_card_shadow_horizontal_offset": 0,
            "collection_card_shadow_vertical_offset": 0,
            "collection_card_shadow_blur": 5,
            "blog_card_style": "card",
            "blog_card_image_padding": 0,
            "blog_card_text_alignment": "left",
            "blog_card_color_scheme": "background-1",
            "blog_card_border_thickness": 0,
            "blog_card_border_opacity": 0,
            "blog_card_corner_radius": 0,
            "blog_card_shadow_opacity": 0,
            "blog_card_shadow_horizontal_offset": 0,
            "blog_card_shadow_vertical_offset": 0,
            "blog_card_shadow_blur": 10,
            "text_boxes_border_thickness": 0,
            "text_boxes_border_opacity": 10,
            "text_boxes_radius": 0,
            "text_boxes_shadow_opacity": 0,
            "text_boxes_shadow_horizontal_offset": 0,
            "text_boxes_shadow_vertical_offset": 4,
            "text_boxes_shadow_blur": 5,
            "media_border_thickness": 1,
            "media_border_opacity": 5,
            "media_radius": 0,
            "media_shadow_opacity": 0,
            "media_shadow_horizontal_offset": 0,
            "media_shadow_vertical_offset": 4,
            "media_shadow_blur": 5,
            "popup_border_thickness": 1,
            "popup_border_opacity": 10,
            "popup_corner_radius": 0,
            "popup_shadow_opacity": 0,
            "popup_shadow_horizontal_offset": 0,
            "popup_shadow_vertical_offset": 4,
            "popup_shadow_blur": 5,
            "drawer_border_thickness": 1,
            "drawer_border_opacity": 10,
            "drawer_shadow_opacity": 0,
            "drawer_shadow_horizontal_offset": 0,
            "drawer_shadow_vertical_offset": 4,
            "drawer_shadow_blur": 5,
            "badge_position": "top right",
            "badge_corner_radius": 40,
            "sale_badge_color_scheme": "background-2",
            "sold_out_badge_color_scheme": "inverse",
            "accent_icons": "text",
            "social_facebook_link": "https:\/\/facebook.com\/shopify",
            "social_instagram_link": "http:\/\/instagram.com\/shopify",
            "social_youtube_link": "https:\/\/www.youtube.com\/shopify",
            "social_tiktok_link": "",
            "social_twitter_link": "https:\/\/twitter.com\/shopify",
            "social_snapchat_link": "",
            "social_pinterest_link": "",
            "social_tumblr_link": "",
            "social_vimeo_link": "",
            "predictive_search_enabled": true,
            "predictive_search_show_vendor": false,
            "predictive_search_show_price": true,
            "currency_code_enabled": false,
            "cart_icon": "cart",
            "custom_svg_width": 22,
            "cart_type": "notification",
            "show_vendor": false,
            "show_cart_note": true,
            "cart_drawer_collection": "",
            "quick_view_text": "Quick View",
            "list_price_text": "List Price",
            "from_text": "Starting at",
            "enable_emailpopup": false,
            "showlogopopup": true,
            "email_popuplogo": "shopify:\/\/shop_images\/dslgo_2ffcba0c-a6cb-45aa-9a0a-ebf1b9d8ca7b.png",
            "showimage": true,
            "newsletter_popup_seconds": "5000",
            "email_discountcode": "10DSL",
            "entrypopup_heading": "GET $10 OFF",
            "entrypopup_text": "Your First Purchase Over $30",
            "entrypopup_button": "Sign Up",
            "entrypopup_bottomtext": "By clicking the button, you'll agree to subscribe.",
            "entry_bgcolor": "#ffffff",
            "entry_color_text": "#000000",
            "checkmark_agree_text_color": "#414141",
            "enable_exitpopup": false,
            "showimage_exit": true,
            "exitpopup_heading": "10% off !",
            "exitpopup_text": "When you complete your order in next:",
            "discountcode": "SAVE10",
            "enable_cross_sell": false,
            "show_cross_sell_collection1": "",
            "popup_enable": false,
            "social_proof_country": "usa",
            "popup_show_name": true,
            "popup_randomly_collection": "",
            "bottom_interval": "5",
            "checkout_heading_font": "Open Sans",
            "checkout_body_font": "Open Sans",
            "checkout_accent_color": "#000000",
            "checkout_button_color": "#121212",
            "brand_headline": "TEST",
            "brand_description": "<p><\/p>",
            "brand_image": "shopify:\/\/shop_images\/ezgif-2-03cf7654a5.jpg",
            "brand_image_width": 100,
            "sections": {
                "main-password-header": {
                    "type": "main-password-header",
                    "settings": {
                        "color_scheme": "background-1"
                    }
                },
                "main-password-footer": {
                    "type": "main-password-footer",
                    "settings": {
                        "color_scheme": "background-1"
                    }
                },
                "pre-footer": {
                    "type": "pre-footer",
                    "settings": {
                        "enable_pre_footer": true,
                        "pre_footer_column1_header": "",
                        "pre_footer_column1_desc": "",
                        "pre_footer_column1_url": "",
                        "pre_footer_column2_header": "",
                        "pre_footer_column2_desc": "",
                        "pre_footer_column2_url": "",
                        "pre_footer_column3_header": "",
                        "pre_footer_column3_desc": "",
                        "pre_footer_column3_url": "",
                        "pre_footer_column4_header": "",
                        "pre_footer_column4_desc": "",
                        "pre_footer_column4_url": "",
                        "color_scheme": "background-2",
                        "padding_top": 40,
                        "padding_bottom": 40
                    }
                },
                "cookie-consent": {
                    "type": "cookie-consent",
                    "settings": {
                        "cc_enable": true,
                        "cc_popup_text": "We use cookies to ensure that we give you the best experience on our website. If you continue we'll assume that you are understand this.",
                        "cc_popup_privacy_url": "shopify:\/\/pages\/privacy-policy",
                        "cc_privacy_text": "Privacy Policy",
                        "cc_accept_text": "Accept",
                        "color_scheme": "accent-1"
                    }
                },
                "footer": {
                    "type": "footer",
                    "blocks": {
                        "de9b594d-4fa7-441c-bb2b-2ada255d29a2": {
                            "type": "text",
                            "settings": {
                                "heading": "Talk about your business",
                                "text": "<p>Share store details, promotions, or brand content with your customers.<\/p>",
                                "footer_page_max_width": "100"
                            }
                        },
                        "2676cc34-ef3f-4876-b2ff-0f8c9c7b70c6": {
                            "type": "link_list",
                            "settings": {
                                "heading": "Quick links",
                                "menu": "footer"
                            }
                        },
                        "e5560794-5591-4a33-baaf-384d85828907": {
                            "type": "link_list",
                            "settings": {
                                "heading": "Main Menu",
                                "menu": "main-menu"
                            }
                        },
                        "7c1a47a8-2949-44ce-a2bb-d35ebde0c5a9": {
                            "type": "newsletter",
                            "settings": {
                                "heading": "Newsletter",
                                "newsletter_text": "Be the first to know about new collections and exclusive offers."
                            }
                        }
                    },
                    "block_order": [
                        "de9b594d-4fa7-441c-bb2b-2ada255d29a2",
                        "2676cc34-ef3f-4876-b2ff-0f8c9c7b70c6",
                        "e5560794-5591-4a33-baaf-384d85828907",
                        "7c1a47a8-2949-44ce-a2bb-d35ebde0c5a9"
                    ],
                    "settings": {
                        "heading_size": "h2",
                        "color_scheme": "background-1",
                        "enable_country_selector": false,
                        "enable_language_selector": false,
                        "show_payment_icons": true,
                        "show_social_media": true,
                        "padding_top": 40,
                        "padding_bottom": 40
                    }
                }
            },
            "content_for_index": []
        },
        "presets": {
            "Default": {
                "logo_width": 90,
                "colors_solid_button_labels": "#ffffff",
                "colors_accent_1": "#121212",
                "gradient_accent_1": "",
                "colors_accent_2": "#334fb4",
                "gradient_accent_2": "",
                "colors_text": "#121212",
                "colors_outline_button_labels": "#121212",
                "colors_background_1": "#ffffff",
                "gradient_background_1": "",
                "colors_background_2": "#f3f3f3",
                "gradient_background_2": "",
                "type_header_font": "assistant_n4",
                "heading_scale": 100,
                "type_body_font": "assistant_n4",
                "body_scale": 100,
                "page_width": 1200,
                "spacing_sections": 0,
                "spacing_grid_horizontal": 8,
                "spacing_grid_vertical": 8,
                "buttons_border_thickness": 1,
                "buttons_border_opacity": 100,
                "buttons_radius": 0,
                "buttons_shadow_opacity": 0,
                "buttons_shadow_horizontal_offset": 0,
                "buttons_shadow_vertical_offset": 4,
                "buttons_shadow_blur": 5,
                "variant_pills_border_thickness": 1,
                "variant_pills_border_opacity": 55,
                "variant_pills_radius": 40,
                "variant_pills_shadow_opacity": 0,
                "variant_pills_shadow_horizontal_offset": 0,
                "variant_pills_shadow_vertical_offset": 4,
                "variant_pills_shadow_blur": 5,
                "inputs_border_thickness": 1,
                "inputs_border_opacity": 55,
                "inputs_radius": 0,
                "inputs_shadow_opacity": 0,
                "inputs_shadow_horizontal_offset": 0,
                "inputs_shadow_vertical_offset": 4,
                "inputs_shadow_blur": 5,
                "card_style": "standard",
                "card_image_padding": 0,
                "card_text_alignment": "left",
                "card_color_scheme": "background-2",
                "card_border_thickness": 0,
                "card_border_opacity": 10,
                "card_corner_radius": 0,
                "card_shadow_opacity": 0,
                "card_shadow_horizontal_offset": 0,
                "card_shadow_vertical_offset": 4,
                "card_shadow_blur": 5,
                "collection_card_style": "standard",
                "collection_card_image_padding": 0,
                "collection_card_text_alignment": "left",
                "collection_card_color_scheme": "background-2",
                "collection_card_border_thickness": 0,
                "collection_card_border_opacity": 10,
                "collection_card_corner_radius": 0,
                "collection_card_shadow_opacity": 0,
                "collection_card_shadow_horizontal_offset": 0,
                "collection_card_shadow_vertical_offset": 4,
                "collection_card_shadow_blur": 5,
                "blog_card_style": "standard",
                "blog_card_image_padding": 0,
                "blog_card_text_alignment": "left",
                "blog_card_color_scheme": "background-2",
                "blog_card_border_thickness": 0,
                "blog_card_border_opacity": 10,
                "blog_card_corner_radius": 0,
                "blog_card_shadow_opacity": 0,
                "blog_card_shadow_horizontal_offset": 0,
                "blog_card_shadow_vertical_offset": 4,
                "blog_card_shadow_blur": 5,
                "text_boxes_border_thickness": 0,
                "text_boxes_border_opacity": 10,
                "text_boxes_radius": 0,
                "text_boxes_shadow_opacity": 0,
                "text_boxes_shadow_horizontal_offset": 0,
                "text_boxes_shadow_vertical_offset": 4,
                "text_boxes_shadow_blur": 5,
                "media_border_thickness": 1,
                "media_border_opacity": 5,
                "media_radius": 0,
                "media_shadow_opacity": 0,
                "media_shadow_horizontal_offset": 0,
                "media_shadow_vertical_offset": 4,
                "media_shadow_blur": 5,
                "popup_border_thickness": 1,
                "popup_border_opacity": 10,
                "popup_corner_radius": 0,
                "popup_shadow_opacity": 0,
                "popup_shadow_horizontal_offset": 0,
                "popup_shadow_vertical_offset": 4,
                "popup_shadow_blur": 5,
                "drawer_border_thickness": 1,
                "drawer_border_opacity": 10,
                "drawer_shadow_opacity": 0,
                "drawer_shadow_horizontal_offset": 0,
                "drawer_shadow_vertical_offset": 4,
                "drawer_shadow_blur": 5,
                "badge_position": "bottom left",
                "badge_corner_radius": 40,
                "sale_badge_color_scheme": "accent-2",
                "sold_out_badge_color_scheme": "inverse",
                "accent_icons": "text",
                "brand_headline": "",
                "brand_description": "<p><\/p>",
                "brand_image_width": 100,
                "social_twitter_link": "",
                "social_facebook_link": "",
                "social_pinterest_link": "",
                "social_instagram_link": "",
                "social_tiktok_link": "",
                "social_tumblr_link": "",
                "social_snapchat_link": "",
                "social_youtube_link": "",
                "social_vimeo_link": "",
                "predictive_search_enabled": true,
                "predictive_search_show_vendor": false,
                "predictive_search_show_price": false,
                "currency_code_enabled": true,
                "cart_type": "notification",
                "show_vendor": false,
                "show_cart_note": false,
                "cart_drawer_collection": "",
                "sections": {
                    "main-password-header": {
                        "type": "main-password-header",
                        "settings": {
                            "color_scheme": "background-1"
                        }
                    },
                    "main-password-footer": {
                        "type": "main-password-footer",
                        "settings": {
                            "color_scheme": "background-1"
                        }
                    }
                }
            }
        }
    }
    EOD,
    'config/settings_schema.json' => <<<EOD
    [
        {
            "name": "theme_info",
            "theme_name": "Manhattan",
            "theme_version": "2023",
            "theme_author": "Drop Ship Lifestyle",
            "theme_documentation_url": "https:\/\/blueprint.dropshiplifestyle.com\/",
            "theme_support_url": "https:\/\/support.shopify.com\/"
        },
        {
            "name": "t:settings_schema.logo.name",
            "settings": [
                {
                    "type": "image_picker",
                    "id": "logo",
                    "label": "t:settings_schema.logo.settings.logo_image.label"
                },
                {
                    "type": "range",
                    "id": "logo_width",
                    "min": 50,
                    "max": 300,
                    "step": 10,
                    "default": 100,
                    "unit": "px",
                    "label": "t:settings_schema.logo.settings.logo_width.label"
                },
                {
                    "type": "image_picker",
                    "id": "favicon",
                    "label": "t:settings_schema.logo.settings.favicon.label",
                    "info": "t:settings_schema.logo.settings.favicon.info"
                }
            ]
        },
        {
            "name": "t:settings_schema.colors.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.colors.settings.header__1.content"
                },
                {
                    "type": "color",
                    "id": "colors_solid_button_labels",
                    "default": "#FFFFFF",
                    "label": "t:settings_schema.colors.settings.colors_solid_button_labels.label",
                    "info": "t:settings_schema.colors.settings.colors_solid_button_labels.info"
                },
                {
                    "type": "color",
                    "id": "colors_accent_1",
                    "default": "#121212",
                    "label": "t:settings_schema.colors.settings.colors_accent_1.label",
                    "info": "t:settings_schema.colors.settings.colors_accent_1.info"
                },
                {
                    "id": "gradient_accent_1",
                    "type": "color_background",
                    "label": "t:settings_schema.colors.settings.gradient_accent_1.label"
                },
                {
                    "type": "color",
                    "id": "colors_accent_2",
                    "default": "#334FB4",
                    "label": "t:settings_schema.colors.settings.colors_accent_2.label"
                },
                {
                    "id": "gradient_accent_2",
                    "type": "color_background",
                    "label": "t:settings_schema.colors.settings.gradient_accent_2.label"
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.colors.settings.header__2.content"
                },
                {
                    "type": "color",
                    "id": "colors_text",
                    "default": "#121212",
                    "label": "t:settings_schema.colors.settings.colors_text.label",
                    "info": "t:settings_schema.colors.settings.colors_text.info"
                },
                {
                    "type": "color",
                    "id": "colors_outline_button_labels",
                    "default": "#121212",
                    "label": "t:settings_schema.colors.settings.colors_outline_button_labels.label",
                    "info": "t:settings_schema.colors.settings.colors_outline_button_labels.info"
                },
                {
                    "type": "color",
                    "id": "colors_background_1",
                    "default": "#FFFFFF",
                    "label": "t:settings_schema.colors.settings.colors_background_1.label"
                },
                {
                    "id": "gradient_background_1",
                    "type": "color_background",
                    "label": "t:settings_schema.colors.settings.gradient_background_1.label"
                },
                {
                    "type": "color",
                    "id": "colors_background_2",
                    "default": "#F3F3F3",
                    "label": "t:settings_schema.colors.settings.colors_background_2.label"
                },
                {
                    "id": "gradient_background_2",
                    "type": "color_background",
                    "label": "t:settings_schema.colors.settings.gradient_background_2.label"
                },
                {
                    "type": "header",
                    "content": "Price (You Save) Color"
                },
                {
                    "type": "color",
                    "id": "you_save_color",
                    "label": "Text Color",
                    "default": "#ff0000"
                }
            ]
        },
        {
            "name": "t:settings_schema.typography.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.typography.settings.header__1.content"
                },
                {
                    "type": "font_picker",
                    "id": "type_header_font",
                    "default": "assistant_n4",
                    "label": "t:settings_schema.typography.settings.type_header_font.label",
                    "info": "t:settings_schema.typography.settings.type_header_font.info"
                },
                {
                    "type": "range",
                    "id": "heading_scale",
                    "min": 100,
                    "max": 150,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.typography.settings.heading_scale.label",
                    "default": 100
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.typography.settings.header__2.content"
                },
                {
                    "type": "font_picker",
                    "id": "type_body_font",
                    "default": "assistant_n4",
                    "label": "t:settings_schema.typography.settings.type_body_font.label",
                    "info": "t:settings_schema.typography.settings.type_body_font.info"
                },
                {
                    "type": "range",
                    "id": "body_scale",
                    "min": 100,
                    "max": 130,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.typography.settings.body_scale.label",
                    "default": 100
                }
            ]
        },
        {
            "name": "t:settings_schema.layout.name",
            "settings": [
                {
                    "type": "range",
                    "id": "page_width",
                    "min": 1000,
                    "max": 1600,
                    "step": 100,
                    "default": 1200,
                    "unit": "px",
                    "label": "t:settings_schema.layout.settings.page_width.label"
                },
                {
                    "type": "range",
                    "id": "spacing_sections",
                    "min": 0,
                    "max": 100,
                    "step": 4,
                    "unit": "px",
                    "label": "t:settings_schema.layout.settings.spacing_sections.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.layout.settings.header__grid.content"
                },
                {
                    "type": "paragraph",
                    "content": "t:settings_schema.layout.settings.paragraph__grid.content"
                },
                {
                    "type": "range",
                    "id": "spacing_grid_horizontal",
                    "min": 4,
                    "max": 40,
                    "step": 4,
                    "default": 8,
                    "unit": "px",
                    "label": "t:settings_schema.layout.settings.spacing_grid_horizontal.label"
                },
                {
                    "type": "range",
                    "id": "spacing_grid_vertical",
                    "min": 4,
                    "max": 40,
                    "step": 4,
                    "default": 8,
                    "unit": "px",
                    "label": "t:settings_schema.layout.settings.spacing_grid_vertical.label"
                }
            ]
        },
        {
            "name": "t:settings_schema.buttons.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "buttons_border_thickness",
                    "min": 0,
                    "max": 12,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 1
                },
                {
                    "type": "range",
                    "id": "buttons_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 100
                },
                {
                    "type": "range",
                    "id": "buttons_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "buttons_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "buttons_shadow_horizontal_offset",
                    "min": -12,
                    "max": 12,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "buttons_shadow_vertical_offset",
                    "min": -12,
                    "max": 12,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "buttons_shadow_blur",
                    "min": 0,
                    "max": 20,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.variant_pills.name",
            "settings": [
                {
                    "type": "paragraph",
                    "content": "t:settings_schema.variant_pills.paragraph"
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "variant_pills_border_thickness",
                    "min": 0,
                    "max": 12,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 1
                },
                {
                    "type": "range",
                    "id": "variant_pills_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 55
                },
                {
                    "type": "range",
                    "id": "variant_pills_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 40
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "variant_pills_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "variant_pills_shadow_horizontal_offset",
                    "min": -12,
                    "max": 12,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "variant_pills_shadow_vertical_offset",
                    "min": -12,
                    "max": 12,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "variant_pills_shadow_blur",
                    "min": 0,
                    "max": 20,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.inputs.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "inputs_border_thickness",
                    "min": 0,
                    "max": 12,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 1
                },
                {
                    "type": "range",
                    "id": "inputs_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 55
                },
                {
                    "type": "range",
                    "id": "inputs_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "inputs_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "inputs_shadow_horizontal_offset",
                    "min": -12,
                    "max": 12,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "inputs_shadow_vertical_offset",
                    "min": -12,
                    "max": 12,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "inputs_shadow_blur",
                    "min": 0,
                    "max": 20,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.cards.name",
            "settings": [
                {
                    "type": "select",
                    "id": "card_style",
                    "options": [
                        {
                            "value": "standard",
                            "label": "t:settings_schema.cards.settings.style.options__1.label"
                        },
                        {
                            "value": "card",
                            "label": "t:settings_schema.cards.settings.style.options__2.label"
                        }
                    ],
                    "default": "standard",
                    "label": "t:settings_schema.cards.settings.style.label"
                },
                {
                    "type": "range",
                    "id": "card_image_padding",
                    "min": 0,
                    "max": 20,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.image_padding.label",
                    "default": 0
                },
                {
                    "type": "select",
                    "id": "card_text_alignment",
                    "options": [
                        {
                            "value": "left",
                            "label": "t:settings_schema.global.settings.text_alignment.options__1.label"
                        },
                        {
                            "value": "center",
                            "label": "t:settings_schema.global.settings.text_alignment.options__2.label"
                        },
                        {
                            "value": "right",
                            "label": "t:settings_schema.global.settings.text_alignment.options__3.label"
                        }
                    ],
                    "default": "left",
                    "label": "t:settings_schema.global.settings.text_alignment.label"
                },
                {
                    "type": "select",
                    "id": "card_color_scheme",
                    "options": [
                        {
                            "value": "accent-1",
                            "label": "t:sections.all.colors.accent_1.label"
                        },
                        {
                            "value": "accent-2",
                            "label": "t:sections.all.colors.accent_2.label"
                        },
                        {
                            "value": "background-1",
                            "label": "t:sections.all.colors.background_1.label"
                        },
                        {
                            "value": "background-2",
                            "label": "t:sections.all.colors.background_2.label"
                        },
                        {
                            "value": "inverse",
                            "label": "t:sections.all.colors.inverse.label"
                        }
                    ],
                    "default": "background-2",
                    "label": "t:sections.all.colors.label"
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "card_border_thickness",
                    "min": 0,
                    "max": 24,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "card_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "card_corner_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "card_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 10
                },
                {
                    "type": "range",
                    "id": "card_shadow_horizontal_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "card_shadow_vertical_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "card_shadow_blur",
                    "min": 0,
                    "max": 40,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.collection_cards.name",
            "settings": [
                {
                    "type": "select",
                    "id": "collection_card_style",
                    "options": [
                        {
                            "value": "standard",
                            "label": "t:settings_schema.collection_cards.settings.style.options__1.label"
                        },
                        {
                            "value": "card",
                            "label": "t:settings_schema.collection_cards.settings.style.options__2.label"
                        }
                    ],
                    "default": "standard",
                    "label": "t:settings_schema.collection_cards.settings.style.label"
                },
                {
                    "type": "range",
                    "id": "collection_card_image_padding",
                    "min": 0,
                    "max": 20,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.image_padding.label",
                    "default": 0
                },
                {
                    "type": "select",
                    "id": "collection_card_text_alignment",
                    "options": [
                        {
                            "value": "left",
                            "label": "t:settings_schema.global.settings.text_alignment.options__1.label"
                        },
                        {
                            "value": "center",
                            "label": "t:settings_schema.global.settings.text_alignment.options__2.label"
                        },
                        {
                            "value": "right",
                            "label": "t:settings_schema.global.settings.text_alignment.options__3.label"
                        }
                    ],
                    "default": "left",
                    "label": "t:settings_schema.global.settings.text_alignment.label"
                },
                {
                    "type": "select",
                    "id": "collection_card_color_scheme",
                    "options": [
                        {
                            "value": "accent-1",
                            "label": "t:sections.all.colors.accent_1.label"
                        },
                        {
                            "value": "accent-2",
                            "label": "t:sections.all.colors.accent_2.label"
                        },
                        {
                            "value": "background-1",
                            "label": "t:sections.all.colors.background_1.label"
                        },
                        {
                            "value": "background-2",
                            "label": "t:sections.all.colors.background_2.label"
                        },
                        {
                            "value": "inverse",
                            "label": "t:sections.all.colors.inverse.label"
                        }
                    ],
                    "default": "background-2",
                    "label": "t:sections.all.colors.label"
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "collection_card_border_thickness",
                    "min": 0,
                    "max": 24,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "collection_card_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "collection_card_corner_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "collection_card_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 10
                },
                {
                    "type": "range",
                    "id": "collection_card_shadow_horizontal_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "collection_card_shadow_vertical_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "collection_card_shadow_blur",
                    "min": 0,
                    "max": 40,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.blog_cards.name",
            "settings": [
                {
                    "type": "select",
                    "id": "blog_card_style",
                    "options": [
                        {
                            "value": "standard",
                            "label": "t:settings_schema.blog_cards.settings.style.options__1.label"
                        },
                        {
                            "value": "card",
                            "label": "t:settings_schema.blog_cards.settings.style.options__2.label"
                        }
                    ],
                    "default": "standard",
                    "label": "t:settings_schema.blog_cards.settings.style.label"
                },
                {
                    "type": "range",
                    "id": "blog_card_image_padding",
                    "min": 0,
                    "max": 20,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.image_padding.label",
                    "default": 0
                },
                {
                    "type": "select",
                    "id": "blog_card_text_alignment",
                    "options": [
                        {
                            "value": "left",
                            "label": "t:settings_schema.global.settings.text_alignment.options__1.label"
                        },
                        {
                            "value": "center",
                            "label": "t:settings_schema.global.settings.text_alignment.options__2.label"
                        },
                        {
                            "value": "right",
                            "label": "t:settings_schema.global.settings.text_alignment.options__3.label"
                        }
                    ],
                    "default": "left",
                    "label": "t:settings_schema.global.settings.text_alignment.label"
                },
                {
                    "type": "select",
                    "id": "blog_card_color_scheme",
                    "options": [
                        {
                            "value": "accent-1",
                            "label": "t:sections.all.colors.accent_1.label"
                        },
                        {
                            "value": "accent-2",
                            "label": "t:sections.all.colors.accent_2.label"
                        },
                        {
                            "value": "background-1",
                            "label": "t:sections.all.colors.background_1.label"
                        },
                        {
                            "value": "background-2",
                            "label": "t:sections.all.colors.background_2.label"
                        },
                        {
                            "value": "inverse",
                            "label": "t:sections.all.colors.inverse.label"
                        }
                    ],
                    "default": "background-2",
                    "label": "t:sections.all.colors.label"
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "blog_card_border_thickness",
                    "min": 0,
                    "max": 24,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "blog_card_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "blog_card_corner_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "blog_card_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 10
                },
                {
                    "type": "range",
                    "id": "blog_card_shadow_horizontal_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "blog_card_shadow_vertical_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "blog_card_shadow_blur",
                    "min": 0,
                    "max": 40,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.content_containers.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "text_boxes_border_thickness",
                    "min": 0,
                    "max": 24,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "text_boxes_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "text_boxes_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "text_boxes_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "text_boxes_shadow_horizontal_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "text_boxes_shadow_vertical_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "text_boxes_shadow_blur",
                    "min": 0,
                    "max": 40,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.media.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "media_border_thickness",
                    "min": 0,
                    "max": 24,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 1
                },
                {
                    "type": "range",
                    "id": "media_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 5
                },
                {
                    "type": "range",
                    "id": "media_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "media_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "media_shadow_horizontal_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "media_shadow_vertical_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "media_shadow_blur",
                    "min": 0,
                    "max": 40,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.popups.name",
            "settings": [
                {
                    "type": "paragraph",
                    "content": "t:settings_schema.popups.paragraph"
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "popup_border_thickness",
                    "min": 0,
                    "max": 24,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 1
                },
                {
                    "type": "range",
                    "id": "popup_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 10
                },
                {
                    "type": "range",
                    "id": "popup_corner_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 0
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "popup_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "popup_shadow_horizontal_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "popup_shadow_vertical_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "popup_shadow_blur",
                    "min": 0,
                    "max": 40,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.drawers.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__border.content"
                },
                {
                    "type": "range",
                    "id": "drawer_border_thickness",
                    "min": 0,
                    "max": 24,
                    "step": 1,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.thickness.label",
                    "default": 1
                },
                {
                    "type": "range",
                    "id": "drawer_border_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 10
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.global.settings.header__shadow.content"
                },
                {
                    "type": "range",
                    "id": "drawer_shadow_opacity",
                    "min": 0,
                    "max": 100,
                    "step": 5,
                    "unit": "%",
                    "label": "t:settings_schema.global.settings.opacity.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "drawer_shadow_horizontal_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.horizontal_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "drawer_shadow_vertical_offset",
                    "min": -40,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.vertical_offset.label",
                    "default": 0
                },
                {
                    "type": "range",
                    "id": "drawer_shadow_blur",
                    "min": 0,
                    "max": 40,
                    "step": 5,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.blur.label",
                    "default": 0
                }
            ]
        },
        {
            "name": "t:settings_schema.badges.name",
            "settings": [
                {
                    "type": "select",
                    "id": "badge_position",
                    "options": [
                        {
                            "value": "bottom left",
                            "label": "t:settings_schema.badges.settings.position.options__1.label"
                        },
                        {
                            "value": "bottom right",
                            "label": "t:settings_schema.badges.settings.position.options__2.label"
                        },
                        {
                            "value": "top left",
                            "label": "t:settings_schema.badges.settings.position.options__3.label"
                        },
                        {
                            "value": "top right",
                            "label": "t:settings_schema.badges.settings.position.options__4.label"
                        }
                    ],
                    "default": "bottom left",
                    "label": "t:settings_schema.badges.settings.position.label"
                },
                {
                    "type": "range",
                    "id": "badge_corner_radius",
                    "min": 0,
                    "max": 40,
                    "step": 2,
                    "unit": "px",
                    "label": "t:settings_schema.global.settings.corner_radius.label",
                    "default": 40
                },
                {
                    "type": "select",
                    "id": "sale_badge_color_scheme",
                    "options": [
                        {
                            "value": "accent-1",
                            "label": "t:sections.all.colors.accent_1.label"
                        },
                        {
                            "value": "accent-2",
                            "label": "t:sections.all.colors.accent_2.label"
                        },
                        {
                            "value": "background-2",
                            "label": "t:sections.all.colors.background_2.label"
                        }
                    ],
                    "default": "accent-2",
                    "label": "t:settings_schema.badges.settings.sale_badge_color_scheme.label"
                },
                {
                    "type": "select",
                    "id": "sold_out_badge_color_scheme",
                    "options": [
                        {
                            "value": "background-1",
                            "label": "t:sections.all.colors.background_1.label"
                        },
                        {
                            "value": "inverse",
                            "label": "t:sections.all.colors.inverse.label"
                        }
                    ],
                    "default": "inverse",
                    "label": "t:settings_schema.badges.settings.sold_out_badge_color_scheme.label"
                }
            ]
        },
        {
            "name": "t:settings_schema.styles.name",
            "settings": [
                {
                    "type": "select",
                    "id": "accent_icons",
                    "options": [
                        {
                            "value": "accent-1",
                            "label": "t:sections.all.colors.accent_1.label"
                        },
                        {
                            "value": "accent-2",
                            "label": "t:sections.all.colors.accent_2.label"
                        },
                        {
                            "value": "outline-button",
                            "label": "t:settings_schema.styles.settings.accent_icons.options__3.label"
                        },
                        {
                            "value": "text",
                            "label": "t:settings_schema.styles.settings.accent_icons.options__4.label"
                        }
                    ],
                    "default": "text",
                    "label": "t:settings_schema.styles.settings.accent_icons.label"
                }
            ]
        },
        {
            "name": "t:settings_schema.social-media.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.social-media.settings.header.content"
                },
                {
                    "type": "text",
                    "id": "social_facebook_link",
                    "label": "t:settings_schema.social-media.settings.social_facebook_link.label",
                    "info": "t:settings_schema.social-media.settings.social_facebook_link.info"
                },
                {
                    "type": "text",
                    "id": "social_instagram_link",
                    "label": "t:settings_schema.social-media.settings.social_instagram_link.label",
                    "info": "t:settings_schema.social-media.settings.social_instagram_link.info"
                },
                {
                    "type": "text",
                    "id": "social_youtube_link",
                    "label": "t:settings_schema.social-media.settings.social_youtube_link.label",
                    "info": "t:settings_schema.social-media.settings.social_youtube_link.info"
                },
                {
                    "type": "text",
                    "id": "social_tiktok_link",
                    "label": "t:settings_schema.social-media.settings.social_tiktok_link.label",
                    "info": "t:settings_schema.social-media.settings.social_tiktok_link.info"
                },
                {
                    "type": "text",
                    "id": "social_twitter_link",
                    "label": "t:settings_schema.social-media.settings.social_twitter_link.label",
                    "info": "t:settings_schema.social-media.settings.social_twitter_link.info"
                },
                {
                    "type": "text",
                    "id": "social_snapchat_link",
                    "label": "t:settings_schema.social-media.settings.social_snapchat_link.label",
                    "info": "t:settings_schema.social-media.settings.social_snapchat_link.info"
                },
                {
                    "type": "text",
                    "id": "social_pinterest_link",
                    "label": "t:settings_schema.social-media.settings.social_pinterest_link.label",
                    "info": "t:settings_schema.social-media.settings.social_pinterest_link.info"
                },
                {
                    "type": "text",
                    "id": "social_tumblr_link",
                    "label": "t:settings_schema.social-media.settings.social_tumblr_link.label",
                    "info": "t:settings_schema.social-media.settings.social_tumblr_link.info"
                },
                {
                    "type": "text",
                    "id": "social_vimeo_link",
                    "label": "t:settings_schema.social-media.settings.social_vimeo_link.label",
                    "info": "t:settings_schema.social-media.settings.social_vimeo_link.info"
                }
            ]
        },
        {
            "name": "t:settings_schema.search_input.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.search_input.settings.header.content"
                },
                {
                    "type": "checkbox",
                    "id": "predictive_search_enabled",
                    "default": true,
                    "label": "t:settings_schema.search_input.settings.predictive_search_enabled.label"
                },
                {
                    "type": "checkbox",
                    "id": "predictive_search_show_vendor",
                    "default": false,
                    "label": "t:settings_schema.search_input.settings.predictive_search_show_vendor.label",
                    "info": "t:settings_schema.search_input.settings.predictive_search_show_vendor.info"
                },
                {
                    "type": "checkbox",
                    "id": "predictive_search_show_price",
                    "default": false,
                    "label": "t:settings_schema.search_input.settings.predictive_search_show_price.label",
                    "info": "t:settings_schema.search_input.settings.predictive_search_show_price.info"
                }
            ]
        },
        {
            "name": "t:settings_schema.currency_format.name",
            "settings": [
                {
                    "type": "header",
                    "content": "t:settings_schema.currency_format.settings.content"
                },
                {
                    "type": "paragraph",
                    "content": "t:settings_schema.currency_format.settings.paragraph"
                },
                {
                    "type": "checkbox",
                    "id": "currency_code_enabled",
                    "label": "t:settings_schema.currency_format.settings.currency_code_enabled.label",
                    "default": true
                }
            ]
        },
        {
            "name": "t:settings_schema.cart.name",
            "settings": [
                {
                    "type": "select",
                    "id": "cart_icon",
                    "options": [
                        {
                            "value": "bag",
                            "label": "Bag"
                        },
                        {
                            "value": "cart",
                            "label": "Cart"
                        },
                        {
                            "value": "custom",
                            "label": "Custom SVG"
                        }
                    ],
                    "default": "cart",
                    "label": "Cart Icon"
                },
                {
                    "type": "image_picker",
                    "id": "custom_svg",
                    "label": "Custom SVG"
                },
                {
                    "type": "range",
                    "id": "custom_svg_width",
                    "min": 20,
                    "max": 50,
                    "step": 1,
                    "default": 24,
                    "unit": "px",
                    "label": "Custom SVG Width"
                },
                {
                    "type": "select",
                    "id": "cart_type",
                    "options": [
                        {
                            "value": "notification",
                            "label": "Dropdown Confirmation"
                        },
                        {
                            "value": "drawer",
                            "label": "Slide Out Cart"
                        },
                        {
                            "value": "popup",
                            "label": "Popup Modal"
                        },
                        {
                            "value": "page",
                            "label": "Redirect to Cart Page"
                        },
                        {
                            "value": "checkout",
                            "label": "Skip cart and go directly to checkout"
                        }
                    ],
                    "default": "notification",
                    "label": "t:settings_schema.cart.settings.cart_type.label"
                },
                {
                    "type": "checkbox",
                    "id": "show_vendor",
                    "label": "t:settings_schema.cart.settings.show_vendor.label",
                    "default": false
                },
                {
                    "type": "checkbox",
                    "id": "show_cart_note",
                    "label": "t:settings_schema.cart.settings.show_cart_note.label",
                    "default": false
                },
                {
                    "type": "header",
                    "content": "t:settings_schema.cart.settings.cart_drawer.header"
                },
                {
                    "type": "collection",
                    "id": "cart_drawer_collection",
                    "label": "t:settings_schema.cart.settings.cart_drawer.collection.label",
                    "info": "t:settings_schema.cart.settings.cart_drawer.collection.info"
                }
            ]
        },
        {
            "name": "Text Translations",
            "settings": [
                {
                    "type": "text",
                    "id": "quick_view_text",
                    "default": "Quick View",
                    "label": "Quick View Text"
                },
                {
                    "type": "header",
                    "content": "PRICE BLOCK TEXT"
                },
                {
                    "type": "text",
                    "id": "list_price_text",
                    "default": "List Price",
                    "label": "List Price Text"
                },
                {
                    "type": "text",
                    "id": "price_text",
                    "default": "Price",
                    "label": "Price Text"
                },
                {
                    "type": "text",
                    "id": "you_save_text",
                    "default": "You Save",
                    "label": "You Save Text"
                },
                {
                    "type": "text",
                    "id": "from_text",
                    "default": "Starting at",
                    "label": "Starting Text"
                },
                {
                    "type": "header",
                    "content": "PRODUCT AVAILABILITY TEXT"
                },
                {
                    "type": "text",
                    "id": "availability_text",
                    "default": "Availability",
                    "label": "Availability Text"
                },
                {
                    "type": "text",
                    "id": "only_text",
                    "default": "Only",
                    "label": "Only Text"
                },
                {
                    "type": "text",
                    "id": "instock_text",
                    "default": "In Stock",
                    "label": "In Stock Text"
                },
                {
                    "type": "text",
                    "id": "outofstock_text",
                    "default": "Out Of Stock",
                    "label": "Out Of Stock Text"
                },
                {
                    "type": "text",
                    "id": "preorder_text",
                    "default": "Pre-order",
                    "label": "Pre-order Text"
                },
                {
                    "type": "text",
                    "id": "unavailable_text",
                    "default": "The product is unavailable.",
                    "label": "Unavailable Product Text"
                },
                {
                    "type": "header",
                    "content": "COUNTDOWN TIMER"
                },
                {
                    "type": "text",
                    "id": "ct_days",
                    "default": "Days",
                    "label": "Days Text"
                },
                {
                    "type": "text",
                    "id": "ct_hours",
                    "default": "Hours",
                    "label": "Hours Text"
                },
                {
                    "type": "text",
                    "id": "ct_minutes",
                    "default": "Minutes",
                    "label": "Minutes Text"
                },
                {
                    "type": "text",
                    "id": "ct_seconds",
                    "default": "Seconds",
                    "label": "Seconds Text"
                },
                {
                    "type": "header",
                    "content": "COLLECTIONS OR TYPE TEXT"
                },
                {
                    "type": "text",
                    "id": "collections_text",
                    "default": "Collections",
                    "label": "Collections Text"
                },
                {
                    "type": "text",
                    "id": "type_text",
                    "default": "Type",
                    "label": "Type Text"
                }
            ]
        },
        {
            "name": "Email Pop-Up Settings",
            "settings": [
                {
                    "type": "checkbox",
                    "id": "enable_emailpopup",
                    "label": "Enable Pop-Up",
                    "default": false
                },
                {
                    "type": "checkbox",
                    "id": "showlogopopup",
                    "label": "Enable Logo in Pop-Up"
                },
                {
                    "type": "image_picker",
                    "id": "email_popuplogo",
                    "label": "Select Logo Image"
                },
                {
                    "type": "checkbox",
                    "id": "showimage",
                    "label": "Enable Image in Pop-Up"
                },
                {
                    "type": "image_picker",
                    "id": "email_popuplogo_image",
                    "label": "Select Image"
                },
                {
                    "type": "select",
                    "id": "newsletter_popup_seconds",
                    "label": "Seconds until Pop-Up is displayed",
                    "options": [
                        {
                            "value": "0",
                            "label": "0 seconds"
                        },
                        {
                            "value": "2000",
                            "label": "2 seconds"
                        },
                        {
                            "value": "5000",
                            "label": "5 seconds"
                        },
                        {
                            "value": "10000",
                            "label": "10 seconds"
                        },
                        {
                            "value": "15000",
                            "label": "15 seconds"
                        },
                        {
                            "value": "30000",
                            "label": "30 seconds"
                        },
                        {
                            "value": "60000",
                            "label": "60 seconds"
                        }
                    ],
                    "default": "2000"
                },
                {
                    "type": "text",
                    "id": "email_discountcode",
                    "label": "Discount Code",
                    "default": "SAVE10"
                },
                {
                    "type": "text",
                    "id": "newsletter_popup_max_width",
                    "label": "Maximum width (in pixels)",
                    "default": "600"
                },
                {
                    "type": "text",
                    "id": "entrypopup_heading",
                    "label": "Heading",
                    "default": "GET $10 OFF"
                },
                {
                    "type": "text",
                    "id": "entrypopup_text",
                    "label": "Text",
                    "default": "Your First Purchase Over $30"
                },
                {
                    "type": "text",
                    "id": "entry_timer",
                    "label": "Countdown Timer Date (in sec.)",
                    "default": "27000"
                },
                {
                    "type": "text",
                    "id": "entrypopup_button",
                    "label": "Button Text",
                    "default": "SUBSCRIBE"
                },
                {
                    "type": "textarea",
                    "id": "entrypopup_bottomtext",
                    "label": "Bottom Text",
                    "default": "By clicking the button, you'll agree to subscribe."
                },
                {
                    "type": "color",
                    "id": "entry_bgcolor",
                    "label": "Background Color",
                    "default": "#ffffff"
                },
                {
                    "type": "color",
                    "id": "entry_color_text",
                    "label": "Heading Text Color",
                    "default": "#414141"
                },
                {
                    "type": "color",
                    "id": "checkmark_agree_text_color",
                    "label": "Body Text color",
                    "default": "#000"
                }
            ]
        },
        {
            "name": "Exit Pop-Up Settings",
            "settings": [
                {
                    "type": "checkbox",
                    "id": "enable_exitpopup",
                    "label": "Enable Pop-up",
                    "default": false
                },
                {
                    "type": "checkbox",
                    "id": "showimage_exit",
                    "label": "Enable Image in Pop-Up"
                },
                {
                    "type": "image_picker",
                    "id": "exit_popuplogo_image",
                    "label": "Select Image"
                },
                {
                    "type": "text",
                    "id": "exitpopup_heading",
                    "label": "Heading",
                    "default": "10% off !"
                },
                {
                    "type": "text",
                    "id": "exitpopup_text",
                    "label": "Text",
                    "default": "When you complete your order in next:"
                },
                {
                    "type": "text",
                    "id": "discountcode",
                    "label": "Discount Code",
                    "default": "SAVE10"
                },
                {
                    "type": "select",
                    "id": "exit_popup_seconds",
                    "label": "Seconds until Pop-Up is displayed",
                    "options": [
                        {
                            "value": "0",
                            "label": "0 seconds"
                        },
                        {
                            "value": "2000",
                            "label": "2 seconds"
                        },
                        {
                            "value": "5000",
                            "label": "5 seconds"
                        },
                        {
                            "value": "10000",
                            "label": "10 seconds"
                        },
                        {
                            "value": "15000",
                            "label": "15 seconds"
                        },
                        {
                            "value": "30000",
                            "label": "30 seconds"
                        },
                        {
                            "value": "60000",
                            "label": "60 seconds"
                        }
                    ],
                    "default": "5000"
                },
                {
                    "type": "text",
                    "id": "exit_timer",
                    "label": "Countdown Timer Date (in sec.)",
                    "default": "27000"
                },
                {
                    "type": "color",
                    "id": "exit_bgcolor",
                    "label": "Background Color",
                    "default": "#ffffff"
                },
                {
                    "type": "color",
                    "id": "exit_heading_color_text",
                    "label": "Heading Text Color",
                    "default": "#414141"
                },
                {
                    "type": "color",
                    "id": "exit_body_color_text",
                    "label": "Body Text Color",
                    "default": "#414141"
                },
                {
                    "type": "color",
                    "id": "exit_sale_color_text",
                    "label": "Sale Text Color",
                    "default": "#414141"
                }
            ]
        },
        {
            "name": "Cross-Sell Pop-Up Settings",
            "settings": [
                {
                    "type": "checkbox",
                    "id": "enable_cross_sell",
                    "label": "Cross Sell Enable",
                    "info": "WARNING: Only enable the cross-sell app if you have selected a collection for it. Use only one cross-sell tag per product.",
                    "default": false
                },
                {
                    "type": "text",
                    "id": "cross_sell_heading",
                    "label": "Cross-sell Heading",
                    "default": "Add your cross-sell header text here"
                },
                {
                    "type": "header",
                    "content": "Collection Set 1"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection1",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-1"
                },
                {
                    "type": "header",
                    "content": "Collection Set 2"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection2",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-2"
                },
                {
                    "type": "header",
                    "content": "Collection Set 3"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection3",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-3"
                },
                {
                    "type": "header",
                    "content": "Collection Set 4"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection4",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-4"
                },
                {
                    "type": "header",
                    "content": "Collection Set 5"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection5",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-5"
                },
                {
                    "type": "header",
                    "content": "Collection Set 6"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection6",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-6"
                },
                {
                    "type": "header",
                    "content": "Collection Set 7"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection7",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-7"
                },
                {
                    "type": "header",
                    "content": "Collection Set 8"
                },
                {
                    "type": "collection",
                    "id": "show_cross_sell_collection8",
                    "label": "Show For Cross sell",
                    "info": "use tag : cross-sell-8"
                },
                {
                    "type": "color",
                    "id": "cross_sell_popup_heading_font_color",
                    "label": "Heading color",
                    "default": "#000000"
                },
                {
                    "type": "select",
                    "id": "cross_sell_popup_heading_font_size",
                    "label": "  Heading font size",
                    "default": "14",
                    "options": [
                        {
                            "value": "12",
                            "label": "12"
                        },
                        {
                            "value": "13",
                            "label": "13"
                        },
                        {
                            "value": "14",
                            "label": "14"
                        },
                        {
                            "value": "15",
                            "label": "15"
                        },
                        {
                            "value": "16",
                            "label": "16"
                        },
                        {
                            "value": "17",
                            "label": "17"
                        },
                        {
                            "value": "18",
                            "label": "18"
                        },
                        {
                            "value": "19",
                            "label": "19"
                        },
                        {
                            "value": "20",
                            "label": "20"
                        },
                        {
                            "value": "21",
                            "label": "21"
                        },
                        {
                            "value": "22",
                            "label": "22"
                        },
                        {
                            "value": "23",
                            "label": "23"
                        },
                        {
                            "value": "24",
                            "label": "24"
                        },
                        {
                            "value": "25",
                            "label": "25"
                        },
                        {
                            "value": "26",
                            "label": "26"
                        },
                        {
                            "value": "28",
                            "label": "28"
                        },
                        {
                            "value": "29",
                            "label": "29"
                        },
                        {
                            "value": "30",
                            "label": "30"
                        },
                        {
                            "value": "31",
                            "label": "31"
                        },
                        {
                            "value": "32",
                            "label": "32"
                        },
                        {
                            "value": "33",
                            "label": "33"
                        },
                        {
                            "value": "34",
                            "label": "34"
                        },
                        {
                            "value": "35",
                            "label": "35"
                        },
                        {
                            "value": "36",
                            "label": "36"
                        },
                        {
                            "value": "37",
                            "label": "37"
                        },
                        {
                            "value": "38",
                            "label": "38"
                        },
                        {
                            "value": "39",
                            "label": "39"
                        },
                        {
                            "value": "40",
                            "label": "40"
                        },
                        {
                            "value": "41",
                            "label": "42"
                        },
                        {
                            "value": "42",
                            "label": "42"
                        },
                        {
                            "value": "43",
                            "label": "43"
                        },
                        {
                            "value": "44",
                            "label": "44"
                        },
                        {
                            "value": "45",
                            "label": "45"
                        },
                        {
                            "value": "46",
                            "label": "46"
                        },
                        {
                            "value": "47",
                            "label": "47"
                        },
                        {
                            "value": "48",
                            "label": "48"
                        },
                        {
                            "value": "49",
                            "label": "49"
                        },
                        {
                            "value": "50",
                            "label": "50"
                        },
                        {
                            "value": "51",
                            "label": "51"
                        },
                        {
                            "value": "52",
                            "label": "52"
                        },
                        {
                            "value": "53",
                            "label": "53"
                        },
                        {
                            "value": "54",
                            "label": "54"
                        },
                        {
                            "value": "55",
                            "label": "55"
                        },
                        {
                            "value": "56",
                            "label": "56"
                        },
                        {
                            "value": "57",
                            "label": "57"
                        },
                        {
                            "value": "58",
                            "label": "58"
                        },
                        {
                            "value": "59",
                            "label": "59"
                        },
                        {
                            "value": "60",
                            "label": "60"
                        }
                    ]
                }
            ]
        },
        {
            "name": "Social-Proof Pop-Up Settings",
            "settings": [
                {
                    "type": "checkbox",
                    "id": "popup_enable",
                    "label": "Enable Pop-up"
                },
                {
                    "type": "select",
                    "id": "social_proof_country",
                    "options": [
                        {
                            "value": "usa",
                            "label": "USA"
                        },
                        {
                            "value": "canada",
                            "label": "Canada"
                        },
                        {
                            "value": "mexico",
                            "label": "Mexico"
                        },
                        {
                            "value": "uk",
                            "label": "UK"
                        },
                        {
                            "value": "australia",
                            "label": "Australia"
                        },
                        {
                            "value": "europe",
                            "label": "Europe"
                        },
                        {
                            "value": "italy",
                            "label": "Italy"
                        },
                        {
                            "value": "france",
                            "label": "France"
                        },
                        {
                            "value": "portugal",
                            "label": "Portugal"
                        }
                    ],
                    "default": "usa",
                    "label": "Country to show"
                },
                {
                    "type": "checkbox",
                    "id": "popup_disable_mobile",
                    "label": "Disable Pop-up on mobile"
                },
                {
                    "type": "checkbox",
                    "id": "popup_show_name",
                    "label": "Show Customer Name"
                },
                {
                    "type": "collection",
                    "id": "popup_randomly_collection",
                    "label": "Collection"
                },
                {
                    "type": "textarea",
                    "id": "bottom_message",
                    "label": "Display Message",
                    "default": "purchased a"
                },
                {
                    "type": "text",
                    "id": "bottom_interval",
                    "label": "Popup Frequency(In Seconds)",
                    "default": "15"
                }
            ]
        },
        {
            "name": "Drop Ship Lifestyle Tracking",
            "settings": [
                {
                    "type": "checkbox",
                    "id": "enable_dsl_track",
                    "label": "Enable Drop Ship Lifestyle tracking",
                    "info": "Drop Ship Lifestyle tracks data to improve this theme.  Click here to disable tracking.",
                    "default": true
                }
            ]
        }
    ]
    EOD,
     
    'templates/index.json' => <<<EOD
    {
        "sections": {
            "37246f17-58cf-4c25-8362-88932ab7b284": {
                "type": "slideshow",
                "blocks": {
                    "template--16033830928561__37246f17-58cf-4c25-8362-88932ab7b284-slide-1": {
                        "type": "slide",
                        "settings": {
                            "heading": "Image slide",
                            "heading_size": "h1",
                            "heading_color": "rgba(0,0,0,0)",
                            "subheading": "Tell your brand's story through images",
                            "text_color": "rgba(0,0,0,0)",
                            "button_label": "Button Label",
                            "link": "",
                            "button_color": "rgba(0,0,0,0)",
                            "button_textcolor": "rgba(0,0,0,0)",
                            "box_align": "middle-left",
                            "show_text_box": true,
                            "text_alignment": "center",
                            "image_overlay_opacity": 0,
                            "color_scheme": "background-2",
                            "text_alignment_mobile": "center"
                        }
                    },
                    "template--16033830928561__37246f17-58cf-4c25-8362-88932ab7b284-slide-2": {
                        "type": "slide",
                        "settings": {
                            "heading": "Image slide",
                            "heading_size": "h1",
                            "heading_color": "rgba(0,0,0,0)",
                            "subheading": "Tell your brand's story through images",
                            "text_color": "rgba(0,0,0,0)",
                            "button_label": "Button Label",
                            "link": "",
                            "button_color": "rgba(0,0,0,0)",
                            "button_textcolor": "rgba(0,0,0,0)",
                            "box_align": "middle-center",
                            "show_text_box": true,
                            "text_alignment": "center",
                            "image_overlay_opacity": 0,
                            "color_scheme": "background-2",
                            "text_alignment_mobile": "center"
                        }
                    },
                    "ea9622ae-3804-4860-bc0f-953a877628c2": {
                        "type": "slide",
                        "settings": {
                            "heading": "Image slide",
                            "heading_size": "h1",
                            "heading_color": "rgba(0,0,0,0)",
                            "subheading": "Tell your brand's story through images",
                            "text_color": "rgba(0,0,0,0)",
                            "button_label": "Button Label",
                            "link": "",
                            "button_color": "rgba(0,0,0,0)",
                            "button_textcolor": "rgba(0,0,0,0)",
                            "box_align": "middle-right",
                            "show_text_box": true,
                            "text_alignment": "center",
                            "image_overlay_opacity": 0,
                            "color_scheme": "background-2",
                            "text_alignment_mobile": "center"
                        }
                    }
                },
                "block_order": [
                    "template--16033830928561__37246f17-58cf-4c25-8362-88932ab7b284-slide-1",
                    "template--16033830928561__37246f17-58cf-4c25-8362-88932ab7b284-slide-2",
                    "ea9622ae-3804-4860-bc0f-953a877628c2"
                ],
                "settings": {
                    "layout": "full_bleed",
                    "slide_height": "adapt_image",
                    "slider_visual": "dots",
                    "auto_rotate": false,
                    "change_slides_speed": 5,
                    "slideshow_control_color": "#ffffff",
                    "image_behavior": "none",
                    "show_text_below": true,
                    "if_not_text_below": "overlay",
                    "accessibility_info": "Slideshow about our brand",
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            },
            "8ba2930d-da96-44f5-bc70-faa70cef1056": {
                "type": "collection-list",
                "blocks": {
                    "template--16033830928561__8ba2930d-da96-44f5-bc70-faa70cef1056-featured_collection-3": {
                        "type": "featured_collection",
                        "settings": {
                            "collection": ""
                        }
                    },
                    "6aea1e27-17f7-45f7-9e6c-ffaf9f4e27c1": {
                        "type": "featured_collection",
                        "settings": {
                            "collection": ""
                        }
                    },
                    "d130504e-6559-4ac4-8d04-a78aad40926a": {
                        "type": "featured_collection",
                        "settings": {
                            "collection": ""
                        }
                    }
                },
                "block_order": [
                    "template--16033830928561__8ba2930d-da96-44f5-bc70-faa70cef1056-featured_collection-3",
                    "6aea1e27-17f7-45f7-9e6c-ffaf9f4e27c1",
                    "d130504e-6559-4ac4-8d04-a78aad40926a"
                ],
                "settings": {
                    "title": "Collections",
                    "heading_size": "h2",
                    "image_ratio": "square",
                    "collection_description": false,
                    "columns_desktop": 3,
                    "text_overlay": false,
                    "text_align": "bottom-center",
                    "text_overlay_opacity": 40,
                    "overlay_color": "#121212",
                    "text_color": "#ffffff",
                    "color_scheme": "background-1",
                    "show_view_all": false,
                    "columns_mobile": "1",
                    "swipe_on_mobile": false,
                    "padding_top": 36,
                    "padding_bottom": 60,
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            },
            "59477b97-be5a-4ed6-8cfe-48d4b93e5fd3": {
                "type": "rich-text",
                "blocks": {
                    "template--16033830928561__59477b97-be5a-4ed6-8cfe-48d4b93e5fd3-heading-1": {
                        "type": "heading",
                        "settings": {
                            "heading": "Talk about your brand",
                            "heading_size": "h2"
                        }
                    },
                    "template--16033830928561__59477b97-be5a-4ed6-8cfe-48d4b93e5fd3-text-1": {
                        "type": "text",
                        "settings": {
                            "text": "<p>Share information about your brand with your customers. Describe a product, make announcements, or welcome customers to your store.<\/p>"
                        }
                    },
                    "template--16033830928561__59477b97-be5a-4ed6-8cfe-48d4b93e5fd3-button-1": {
                        "type": "button",
                        "settings": {
                            "button_label": "Button label",
                            "button_link": "",
                            "button_style_secondary": false,
                            "button_label_2": "",
                            "button_link_2": "",
                            "button_style_secondary_2": false
                        }
                    }
                },
                "block_order": [
                    "template--16033830928561__59477b97-be5a-4ed6-8cfe-48d4b93e5fd3-heading-1",
                    "template--16033830928561__59477b97-be5a-4ed6-8cfe-48d4b93e5fd3-text-1",
                    "template--16033830928561__59477b97-be5a-4ed6-8cfe-48d4b93e5fd3-button-1"
                ],
                "settings": {
                    "desktop_content_position": "center",
                    "content_alignment": "center",
                    "color_scheme": "background-2",
                    "full_width": true,
                    "padding_top": 40,
                    "padding_bottom": 52,
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            },
            "ff813ca2-5c28-4c28-baf5-6c7e56daa10c": {
                "type": "featured-collection",
                "settings": {
                    "title": "Featured collection",
                    "heading_size": "h2",
                    "description": "",
                    "show_description": false,
                    "description_style": "body",
                    "collection": "",
                    "products_to_show": 4,
                    "columns_desktop": 4,
                    "full_width": false,
                    "show_view_all": true,
                    "view_all_style": "solid",
                    "enable_desktop_slider": false,
                    "color_scheme": "background-1",
                    "image_ratio": "square",
                    "show_secondary_image": false,
                    "show_vendor": false,
                    "show_rating": false,
                    "enable_quick_add": true,
                    "columns_mobile": "1",
                    "swipe_on_mobile": false,
                    "padding_top": 36,
                    "padding_bottom": 52,
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            },
            "574199a3-93b9-49bd-9e1c-69f484ff175c": {
                "type": "image-banner",
                "blocks": {
                    "template--16142768144561__574199a3-93b9-49bd-9e1c-69f484ff175c-heading-1": {
                        "type": "heading",
                        "settings": {
                            "heading": "Image banner",
                            "heading_size": "h1",
                            "heading_color": "rgba(0,0,0,0)"
                        }
                    },
                    "template--16142768144561__574199a3-93b9-49bd-9e1c-69f484ff175c-text-1": {
                        "type": "text",
                        "settings": {
                            "text": "Give customers details about the banner image(s) or content on the template.",
                            "text_style": "body",
                            "text_color": "rgba(0,0,0,0)"
                        }
                    },
                    "template--16142768144561__574199a3-93b9-49bd-9e1c-69f484ff175c-buttons-1": {
                        "type": "buttons",
                        "settings": {
                            "button_label_1": "Button label",
                            "button_link_1": "",
                            "button_color_1": "rgba(0,0,0,0)",
                            "button_textcolor_1": "rgba(0,0,0,0)",
                            "button_label_2": "Button label",
                            "button_link_2": "",
                            "button_color_2": "rgba(0,0,0,0)",
                            "button_textcolor_2": "rgba(0,0,0,0)"
                        }
                    }
                },
                "block_order": [
                    "template--16142768144561__574199a3-93b9-49bd-9e1c-69f484ff175c-heading-1",
                    "template--16142768144561__574199a3-93b9-49bd-9e1c-69f484ff175c-text-1",
                    "template--16142768144561__574199a3-93b9-49bd-9e1c-69f484ff175c-buttons-1"
                ],
                "settings": {
                    "image_overlay_opacity": 0,
                    "image_height": "adapt",
                    "desktop_content_position": "middle-center",
                    "show_text_box": true,
                    "desktop_content_alignment": "center",
                    "color_scheme": "background-1",
                    "image_behavior": "none",
                    "mobile_content_alignment": "center",
                    "stack_images_on_mobile": true,
                    "show_text_below": true,
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            },
            "0e6ce4f9-1d72-4b18-a41e-e95a600cbd82": {
                "type": "newsletter",
                "blocks": {
                    "template--16033830928561__0e6ce4f9-1d72-4b18-a41e-e95a600cbd82-heading-1": {
                        "type": "heading",
                        "settings": {
                            "heading": "Subscribe to our emails",
                            "heading_size": "h2"
                        }
                    },
                    "template--16033830928561__0e6ce4f9-1d72-4b18-a41e-e95a600cbd82-paragraph-1": {
                        "type": "paragraph",
                        "settings": {
                            "text": "<p>Be the first to know about new collections and exclusive offers.<\/p>"
                        }
                    },
                    "template--16033830928561__0e6ce4f9-1d72-4b18-a41e-e95a600cbd82-email_form-1": {
                        "type": "email_form",
                        "settings": {}
                    }
                },
                "block_order": [
                    "template--16033830928561__0e6ce4f9-1d72-4b18-a41e-e95a600cbd82-heading-1",
                    "template--16033830928561__0e6ce4f9-1d72-4b18-a41e-e95a600cbd82-paragraph-1",
                    "template--16033830928561__0e6ce4f9-1d72-4b18-a41e-e95a600cbd82-email_form-1"
                ],
                "settings": {
                    "color_scheme": "background-2",
                    "full_width": true,
                    "padding_top": 40,
                    "padding_bottom": 52,
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            },
            "c23867ee-6d6b-4199-a523-198cb53d1ca8": {
                "type": "featured-blog",
                "settings": {
                    "heading": "Blog posts",
                    "heading_size": "h2",
                    "blog": "news",
                    "post_limit": 3,
                    "columns_desktop": 3,
                    "color_scheme": "background-1",
                    "image_height": "medium",
                    "show_image": true,
                    "show_date": true,
                    "show_author": false,
                    "show_view_all": true,
                    "padding_top": 36,
                    "padding_bottom": 36,
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            },
            "recently_viewed_products_WPmjdh": {
                "type": "recently-viewed-products",
                "settings": {
                    "show_recently_viewed_products": true,
                    "show_vendor": false,
                    "title": "Recently Viewed Products",
                    "heading_size": "h1",
                    "color_scheme": "background-1",
                    "padding_top": 36,
                    "padding_bottom": 36,
                    "margin_top": 0,
                    "margin_bottom": 0
                }
            }
        },
        "order": [
            "37246f17-58cf-4c25-8362-88932ab7b284",
            "8ba2930d-da96-44f5-bc70-faa70cef1056",
            "59477b97-be5a-4ed6-8cfe-48d4b93e5fd3",
            "ff813ca2-5c28-4c28-baf5-6c7e56daa10c",
            "574199a3-93b9-49bd-9e1c-69f484ff175c",
            "0e6ce4f9-1d72-4b18-a41e-e95a600cbd82",
            "c23867ee-6d6b-4199-a523-198cb53d1ca8",
            "recently_viewed_products_WPmjdh"
        ]
    }
    EOD,

    

    'layout/theme.liquid' => "
<!DOCTYPE html>
<html>
<head>
  <title>{{ page_title }} - {{ shop.name }}</title>
  {{ content_for_header }}
</head>
<body>
  {{ content_for_layout }}
</body>
</html>
",

    'sections/header.liquid' => "
<header>
  <h1>{{ shop.name }}</h1>
  <nav>
    <ul>
      <li><a href=\"/collections/all\">Shop</a></li>
      <li><a href=\"/pages/about\">About Us</a></li>
      <li><a href=\"/contact\">Contact</a></li>
    </ul>
  </nav>
</header>
",

    'sections/footer.liquid' => "
<footer>
  <p>&copy; {{ 'now' | date: '%Y' }} {{ shop.name }}. All rights reserved.</p>
</footer>
",




'sections/slideshow.liquid' => <<<EOD
{{ 'section-image-banner.css' | asset_url | stylesheet_tag }}
{{ 'component-slider.css' | asset_url | stylesheet_tag }}
{{ 'component-slideshow.css' | asset_url | stylesheet_tag }}

{%- style -%}
  .section-{{ section.id }}-margin {
     margin-top: {{ section.settings.margin_top | times: 0.75 | round: 0 }}px;
     margin-bottom: {{ section.settings.margin_bottom | times: 0.75 | round: 0 }}px;
   }
   @media screen and (min-width: 750px) {
     .section-{{ section.id }}-margin {
       margin-top: {{ section.settings.margin_top }}px;
       margin-bottom: {{ section.settings.margin_bottom }}px;
     }
   }
{%- endstyle -%}    

{%- if section.settings.slide_height == 'adapt_image' and section.blocks.first.settings.image != blank -%}
  {%- style -%}
    @media screen and (max-width: 749px) {
      #Slider-{{ section.id }}::before,
      #Slider-{{ section.id }} .media::before,
      #Slider-{{ section.id }}:not(.banner--mobile-bottom) .banner__content::before {
        padding-bottom: {{ 1 | divided_by: section.blocks.first.settings.image.aspect_ratio | times: 100 }}%;
        content: '';
        display: block;
      }
    }

    @media screen and (min-width: 750px) {
      #Slider-{{ section.id }}::before,
      #Slider-{{ section.id }} .media::before {
        padding-bottom: {{ 1 | divided_by: section.blocks.first.settings.image.aspect_ratio | times: 100 }}%;
        content: '';
        display: block;
      }
    }
  {%- endstyle -%}
{%- endif -%}

<slideshow-component id="Slideshow-{{ section.id }}"
  class="section-{{ section.id }}-margin slider-mobile-gutter{% if section.settings.layout == 'grid' %} page-width{% endif %}{% if section.settings.show_text_below %} mobile-text-below{% endif %}{% if section.settings.show_text_below == false %}{% if section.settings.if_not_text_below == 'inherit' %} content-inherit{% endif %}{% endif %}"
  role="region"
  aria-roledescription="{{ 'sections.slideshow.carousel' | t }}"
  aria-label="{{ section.settings.accessibility_info | escape }}"
>
  {%- if section.settings.auto_rotate and section.blocks.size > 1 -%}
    <div class="slideshow__controls slideshow__controls--top slider-buttons no-js-hidden{% if section.settings.show_text_below %} slideshow__controls--border-radius-mobile{% endif %}">
      <button
        type="button"
        class="slider-button slider-button--prev"
        name="previous"
        aria-label="{{ 'sections.slideshow.previous_slideshow' | t }}"
        aria-controls="Slider-{{ section.id }}"
      >
        {% render 'icon-caret' %}
      </button>
      <div class="slider-counter slider-counter--{{ section.settings.slider_visual }}{% if section.settings.slider_visual == 'counter' or section.settings.slider_visual == 'numbers' %} caption{% endif %}">
        {%- if section.settings.slider_visual == 'counter' -%}
          <span class="slider-counter--current">1</span>
          <span aria-hidden="true"> / </span>
          <span class="visually-hidden">{{ 'general.slider.of' | t }}</span>
          <span class="slider-counter--total">{{ section.blocks.size }}</span>
        {%- else -%}
          <div class="slideshow__control-wrapper">
            {%- for block in section.blocks -%}
              <button
                class="slider-counter__link slider-counter__link--{{ section.settings.slider_visual }} link"
                aria-label="{{ 'sections.slideshow.load_slide' | t }} {{ forloop.index }} {{ 'general.slider.of' | t }} {{ forloop.length }}"
                aria-controls="Slider-{{ section.id }}"
              >
                {%- if section.settings.slider_visual == 'numbers' -%}
                  {{ forloop.index -}}
                {%- else -%}
                  <span class="dot"></span>
                {%- endif -%}
              </button>
            {%- endfor -%}
          </div>
        {%- endif -%}
      </div>
      <button
        type="button"
        class="slider-button slider-button--next"
        name="next"
        aria-label="{{ 'sections.slideshow.next_slideshow' | t }}"
        aria-controls="Slider-{{ section.id }}"
      >
        {% render 'icon-caret' %}
      </button>

      {%- if section.settings.auto_rotate -%}
        <button
          type="button"
          class="hide slideshow__autoplay slider-button no-js-hidden{% if section.settings.auto_rotate == false %} slideshow__autoplay--paused{% endif %}"
          aria-label="{{ 'sections.slideshow.pause_slideshow' | t }}"
        >
          {%- render 'icon-pause' -%}
          {%- render 'icon-play' -%}
        </button>
      {%- endif -%}
    </div>
    <noscript>
      <div class="slider-buttons">
        <div class="slider-counter">
          {%- for block in section.blocks -%}
            <a
              href="#Slide-{{ section.id }}-{{ forloop.index }}"
              class="slider-counter__link link"
              aria-label="{{ 'sections.slideshow.load_slide' | t }} {{ forloop.index }} {{ 'general.slider.of' | t }} {{ forloop.length }}"
            >
              {{ forloop.index }}
            </a>
          {%- endfor -%}
        </div>
      </div>
    </noscript>
  {%- endif -%}

  <div
    class="slideshow banner banner--{{ section.settings.slide_height }} grid grid--1-col slider slider--everywhere{% if section.settings.show_text_below %} banner--mobile-bottom{% endif %}{% if section.settings.show_text_below == false %}{% if section.settings.if_not_text_below == 'inherit' %} banner-content-inherit{% endif %}{% endif %}{% if section.blocks.first.settings.image == blank %} slideshow--placeholder{% endif %}"
    id="Slider-{{ section.id }}"
    aria-live="polite"
    aria-atomic="true"
    data-autoplay="{{ section.settings.auto_rotate }}"
    data-speed="{{ section.settings.change_slides_speed }}"
  >
    {%- for block in section.blocks -%}
      <style>
        #Slide-{{ section.id }}-{{ forloop.index }} .banner__media::after {
          opacity: {{ block.settings.image_overlay_opacity | divided_by: 100.0 }};
        }
         {% if block.settings.heading_color != 'rgba(0,0,0,0)' %}
           #Slide-{{ section.id }}-{{ forloop.index }} .banner__heading{
              color: {{ block.settings.heading_color }};
           }
         {% endif %}   
         {% if block.settings.text_color != 'rgba(0,0,0,0)' %}  
           #Slide-{{ section.id }}-{{ forloop.index }} .banner__text{
              color: {{ block.settings.text_color }};
           }
         {% endif %} 
         {% if block.settings.button_color != 'rgba(0,0,0,0)' or block.settings.button_textcolor != 'rgba(0,0,0,0)' %}
           #Slide-{{ section.id }}-{{ forloop.index }} .button-color{
               background-color: {{ block.settings.button_color }};
               color: {{ block.settings.button_textcolor }};
           }
           #Slide-{{ section.id }}-{{ forloop.index }} .button-color:after{
               box-shadow: 0 0 0 calc(var(--buttons-border-width) + var(--border-offset)) rgba(var(--color-button-text),var(--border-opacity)),0 0 0 var(--buttons-border-width) {{ block.settings.button_color }};
           }
           #Slide-{{ section.id }}-{{ forloop.index }} .button-color:not([disabled]):hover:after, #Slide-{{ section.id }}-{{ forloop.index }} .button-color-1:hover:after{
               box-shadow: 0 0 0 calc(var(--buttons-border-width) + var(--border-offset)) rgba(var(--color-button-text),var(--border-opacity)),0 0 0 calc(var(--buttons-border-width) + 1px) {{ block.settings.button_color }};
           }
         {% endif %} 
      </style>
      <script>
         setTimeout(function() {
           var link = $(".slideshow-link--{{ section.id }}-{{ forloop.index }}").val();
           var heading =  $(".banner__heading--{{ section.id }}-{{ forloop.index }}").val();
           var text = $(".banner__text--{{ section.id }}-{{ forloop.index }}").val();
           var label = $(".banner__label--{{ section.id }}-{{ forloop.index }}").val();
           if(link != undefined){
                  $("#Slide-{{ section.id }}-{{ forloop.index }}").css("cursor","pointer");
                  $("#Slide-{{ section.id }}-{{ forloop.index }}").css("z-index","2");
                  $("#Slide-{{ section.id }}-{{ forloop.index }}").click(function() {
                       window.location = link;
                  });
            }
          },1000);
          setInterval(function() {
             var active = jQuery("#Slideshow-{{ section.id }} #Slide-{{ section.id }}-{{ forloop.index }}").attr("aria-hidden");
             if(active == "true"){
                 $("#Slide-{{ section.id }}-{{ forloop.index }} .slideshow__text-wrapper").fadeOut();
             }
             if(active == "false"){
                 $("#Slide-{{ section.id }}-{{ forloop.index }} .slideshow__text-wrapper").fadeIn();
             } 
          },0);  
      </script>
      <div
        class="slideshow__slide grid__item grid--1-col slider__slide"
        id="Slide-{{ section.id }}-{{ forloop.index }}"
        {{ block.shopify_attributes }}
        role="group"
        aria-roledescription="{{ 'sections.slideshow.slide' | t }}"
        aria-label="{{ forloop.index }} {{ 'general.slider.of' | t }} {{ forloop.length }}"
        tabindex="-1"
      >
        <div class="slideshow__media banner__media media{% if block.settings.image == blank %} placeholder{% endif %}{% if section.settings.image_behavior != 'none' %} animate--{{ section.settings.image_behavior }}{% endif %}">
          {%- if block.settings.image -%}
            {%- liquid
              assign height = block.settings.image.width | divided_by: block.settings.image.aspect_ratio | round
              if section.settings.image_behavior == 'ambient'
                assign sizes = '120vw'
                assign widths = '450, 660, 900, 1320, 1800, 2136, 2400, 3600, 7680'
              else
                assign sizes = '100vw'
                assign widths = '375, 550, 750, 1100, 1500, 1780, 2000, 3000, 3840'
              endif
            -%}
            {{
              block.settings.image
              | image_url: width: 3840
              | image_tag:
                loading: 'lazy',
                height: height,
                sizes: sizes,
                widths: widths
            }}
          {%- else -%}
            {{ 'lifestyle-2' | placeholder_svg_tag: 'placeholder-svg' }}
          {%- endif -%}
        </div>
        <div class="slideshow__text-wrapper banner__content banner__content--{{ block.settings.box_align }} page-width{% if block.settings.show_text_box == false %} banner--desktop-transparent{% endif %}{% if section.settings.show_text_below %}{% if block.settings.heading == blank and block.settings.subheading == blank and block.settings.button_label == blank %} hide{% endif %}{% endif %}">
          <div class="slideshow__text banner__box content-container content-container--full-width-mobile color-{{ block.settings.color_scheme }} gradient slideshow__text--{{ block.settings.text_alignment }} slideshow__text-mobile--{{ block.settings.text_alignment_mobile }}{% if section.settings.show_text_below == false %}{% if block.settings.heading == blank and block.settings.subheading == blank and block.settings.button_label == blank %} hide{% endif %}{% endif %}">
            {%- if block.settings.heading != blank -%}
              <input class="banner__heading--{{ section.id }}-{{ forloop.index }}" type="hidden" value="{{ block.settings.heading }}">
              <h2 class="banner__heading inline-richtext {{ block.settings.heading_size }}">
                {{ block.settings.heading }}
              </h2>
            {%- endif -%}
            {%- if block.settings.subheading != blank -%}
              <input class="banner__text--{{ section.id }}-{{ forloop.index }}" type="hidden" value="{{ block.settings.subheading }}">
              <div class="banner__text rte" {{ block.shopify_attributes }}>
                <p>{{ block.settings.subheading }}</p>
              </div>
            {%- endif -%}
            {%- if block.settings.link != blank -%}
              <input class="slideshow-link--{{ section.id }}-{{ forloop.index }}" type="hidden" value="{{ block.settings.link }}">
            {%- endif -%}  
            {%- if block.settings.button_label != blank -%}
              <input class="banner__label--{{ section.id }}-{{ forloop.index }}" type="hidden" value="{{ block.settings.button_label }}">
              <div class="banner__buttons">
                <a
                  {% if block.settings.link %}
                    href="{{ block.settings.link }}"
                  {% else %}
                    role="link" aria-disabled="true"
                  {% endif %}
                  class="button button-color"
                >
                  {{- block.settings.button_label | escape -}}
                </a>
              </div>
            {%- endif -%}
          </div>
        </div>
      </div>
    {%- endfor -%}
  </div>

  {%- if section.blocks.size > 1 and section.settings.auto_rotate == false -%}
    <div class="slideshow__controls slider-buttons no-js-hidden{% if section.settings.show_text_below %} slideshow__controls--border-radius-mobile{% endif %}">
      <button
        type="button"
        class="slider-button slider-button--prev"
        name="previous"
        aria-label="{{ 'sections.slideshow.previous_slideshow' | t }}"
        aria-controls="Slider-{{ section.id }}"
      >
        {% render 'icon-caret' %}
      </button>
      <div class="slider-counter slider-counter--{{ section.settings.slider_visual }}{% if section.settings.slider_visual == 'counter' or section.settings.slider_visual == 'numbers' %} caption{% endif %}">
        {%- if section.settings.slider_visual == 'counter' -%}
          <span class="slider-counter--current">1</span>
          <span aria-hidden="true"> / </span>
          <span class="visually-hidden">{{ 'general.slider.of' | t }}</span>
          <span class="slider-counter--total">{{ section.blocks.size }}</span>
        {%- else -%}
          <div class="slideshow__control-wrapper">
            {%- for block in section.blocks -%}
              <button
                class="slider-counter__link slider-counter__link--{{ section.settings.slider_visual }} link"
                aria-label="{{ 'sections.slideshow.load_slide' | t }} {{ forloop.index }} {{ 'general.slider.of' | t }} {{ forloop.length }}"
                aria-controls="Slider-{{ section.id }}"
              >
                {%- if section.settings.slider_visual == 'numbers' -%}
                  {{ forloop.index -}}
                {%- else -%}
                  <span class="dot"></span>
                {%- endif -%}
              </button>
            {%- endfor -%}
          </div>
        {%- endif -%}
      </div>
      <button
        type="button"
        class="slider-button slider-button--next"
        name="next"
        aria-label="{{ 'sections.slideshow.next_slideshow' | t }}"
        aria-controls="Slider-{{ section.id }}"
      >
        {% render 'icon-caret' %}
      </button>

      {%- if section.settings.auto_rotate -%}
        <button
          type="button"
          class="slideshow__autoplay slider-button no-js-hidden{% if section.settings.auto_rotate == false %} slideshow__autoplay--paused{% endif %}"
          aria-label="{{ 'sections.slideshow.pause_slideshow' | t }}"
        >
          {%- render 'icon-pause' -%}
          {%- render 'icon-play' -%}
        </button>
      {%- endif -%}
    </div>
    <noscript>
      <div class="slider-buttons">
        <div class="slider-counter">
          {%- for block in section.blocks -%}
            <a
              href="#Slide-{{ section.id }}-{{ forloop.index }}"
              class="slider-counter__link link"
              aria-label="{{ 'sections.slideshow.load_slide' | t }} {{ forloop.index }} {{ 'general.slider.of' | t }} {{ forloop.length }}"
            >
              {{ forloop.index }}
            </a>
          {%- endfor -%}
        </div>
      </div>
    </noscript>
  {%- endif -%}
</slideshow-component>
<style>
  #Slideshow-{{ section.id }} .slider-counter__link--dots .dot{
    border: 0.1rem solid {{ section.settings.slideshow_control_color }}!important;
    box-shadow: 0px 0px 3px 0px #00000080;
    opacity:.5;
  }
  #Slideshow-{{ section.id }} .slider-counter__link--active .dot{
    background-color:{{ section.settings.slideshow_control_color }}!important;
    box-shadow: 0px 0px 5px 0px #00000080;
    opacity:1;
  }
  #Slideshow-{{ section.id }} .slider-button--prev .icon, #Slideshow-{{ section.id }} .slider-button--next .icon{
    filter: drop-shadow(0px 0px 1px rgb(0 0 0 / 0.5));
  }
  #Slideshow-{{ section.id }} .slider-counter, #Slideshow-{{ section.id }} .slider-button {
    color: {{ section.settings.slideshow_control_color }}!important;
  }
  #Slideshow-{{ section.id }} .slider-counter__link--active.slider-counter__link--numbers, #Slideshow-{{ section.id }} .slider-counter__link--numbers {
    color: {{ section.settings.slideshow_control_color }}!important;
  }
  #Slideshow-{{ section.id }} .slider-counter__link--numbers:hover {
    color: {{ section.settings.slideshow_control_color }}!important;
  }
</style> 
{%- if request.design_mode -%}
  <script src="{{ 'theme-editor.js' | asset_url }}" defer="defer"></script>
{%- endif -%}

{% schema %}
{
  "name": "t:sections.slideshow.name",
  "tag": "section",
  "class": "section",
  "disabled_on": {
    "groups": ["header", "footer"]
  },
  "settings": [
    {
      "type": "select",
      "id": "layout",
      "options": [
        {
          "value": "full_bleed",
          "label": "t:sections.slideshow.settings.layout.options__1.label"
        },
        {
          "value": "grid",
          "label": "t:sections.slideshow.settings.layout.options__2.label"
        }
      ],
      "default": "full_bleed",
      "label": "t:sections.slideshow.settings.layout.label"
    },
    {
      "type": "select",
      "id": "slide_height",
      "options": [
        {
          "value": "adapt_image",
          "label": "t:sections.slideshow.settings.slide_height.options__1.label"
        },
        {
          "value": "small",
          "label": "t:sections.slideshow.settings.slide_height.options__2.label"
        },
        {
          "value": "medium",
          "label": "t:sections.slideshow.settings.slide_height.options__3.label"
        },
        {
          "value": "large",
          "label": "t:sections.slideshow.settings.slide_height.options__4.label"
        }
      ],
      "default": "adapt_image",
      "label": "t:sections.slideshow.settings.slide_height.label"
    },
    {
      "type": "select",
      "id": "slider_visual",
      "options": [
        {
          "value": "dots",
          "label": "t:sections.slideshow.settings.slider_visual.options__2.label"
        },
        {
          "value": "counter",
          "label": "t:sections.slideshow.settings.slider_visual.options__1.label"
        },
        {
          "value": "numbers",
          "label": "t:sections.slideshow.settings.slider_visual.options__3.label"
        }
      ],
      "default": "dots",
      "label": "t:sections.slideshow.settings.slider_visual.label"
    },
    {
      "type": "checkbox",
      "id": "auto_rotate",
      "label": "t:sections.slideshow.settings.auto_rotate.label",
      "default": false
    },
    {
      "type": "range",
      "id": "change_slides_speed",
      "min": 3,
      "max": 9,
      "step": 2,
      "unit": "s",
      "label": "t:sections.slideshow.settings.change_slides_speed.label",
      "default": 5
    },
    {
      "type": "color",
      "id": "slideshow_control_color",
	  "label": "Slider Control Color",
	  "default": "#ffffff"
	},
    {
      "type": "header",
      "content": "t:sections.all.animation.content"
    },
    {
      "type": "select",
      "id": "image_behavior",
      "options": [
        {
          "value": "none",
          "label": "t:sections.all.animation.image_behavior.options__1.label"
        },
        {
          "value": "ambient",
          "label": "t:sections.all.animation.image_behavior.options__2.label"
        }
      ],
      "default": "none",
      "label": "t:sections.all.animation.image_behavior.label"
    },
    {
      "type": "header",
      "content": "t:sections.slideshow.settings.mobile.content"
    },
    {
      "type": "checkbox",
      "id": "show_text_below",
      "label": "t:sections.slideshow.settings.show_text_below.label",
      "default": true
    },
    {
      "type": "select",
      "id": "if_not_text_below",
      "options": [
        {
          "value": "overlay",
          "label": "Overlay"
        },
        {
          "value": "inherit",
          "label": "Inherit the desktop content position"
        }
      ],
      "default": "overlay",
      "label": "Position of content on mobile if not below images"
    },
    {
      "type": "header",
      "content": "t:sections.slideshow.settings.accessibility.content"
    },
    {
      "type": "text",
      "id": "accessibility_info",
      "label": "t:sections.slideshow.settings.accessibility.label",
      "info": "t:sections.slideshow.settings.accessibility.info",
      "default": "Slideshow about our brand"
    },
    {
      "type": "header",
      "content": "Section margin"
    },
    {
      "type": "range",
      "id": "margin_top",
      "min": 0,
      "max": 100,
      "step": 4,
      "unit": "px",
      "label": "Top margin",
      "default": 0
    },
    {
      "type": "range",
      "id": "margin_bottom",
      "min": 0,
      "max": 100,
      "step": 4,
      "unit": "px",
      "label": "Bottom margin",
      "default": 0
    }
  ],
  "blocks": [
    {
      "type": "slide",
      "name": "t:sections.slideshow.blocks.slide.name",
      "limit": 5,
      "settings": [
        {
          "type": "image_picker",
          "id": "image",
          "label": "t:sections.slideshow.blocks.slide.settings.image.label"
        },
        {
          "type": "inline_richtext",
          "id": "heading",
          "default": "Image slide",
          "label": "t:sections.slideshow.blocks.slide.settings.heading.label"
        },
        {
          "type": "select",
          "id": "heading_size",
          "options": [
            {
              "value": "h2",
              "label": "t:sections.all.heading_size.options__1.label"
            },
            {
              "value": "h1",
              "label": "t:sections.all.heading_size.options__2.label"
            },
            {
              "value": "h0",
              "label": "t:sections.all.heading_size.options__3.label"
            }
          ],
          "default": "h1",
          "label": "t:sections.all.heading_size.label"
        },
        {
          "type":"color",
          "id":"heading_color",
          "label":"Heading color",
          "default":"rgba(0,0,0,0)"
        },
        {
          "type": "inline_richtext",
          "id": "subheading",
          "default": "Tell your brand's story through images",
          "label": "t:sections.slideshow.blocks.slide.settings.subheading.label"
        },
        {
          "type":"color",
          "id":"text_color",
          "label":"Text color",
          "default":"rgba(0,0,0,0)"
        },
        {
          "type": "text",
          "id": "button_label",
          "default": "Button label",
          "label": "t:sections.slideshow.blocks.slide.settings.button_label.label",
          "info": "t:sections.slideshow.blocks.slide.settings.button_label.info"
        },
        {
          "type": "url",
          "id": "link",
          "label": "t:sections.slideshow.blocks.slide.settings.link.label"
        },
        {
          "type":"color",
          "id":"button_color",
          "label":"Button color",
          "default":"rgba(0,0,0,0)"
        },
        {
          "type":"color",
          "id":"button_textcolor",
          "label":"Button text color",
          "default":"rgba(0,0,0,0)"
        },
        {
          "type": "select",
          "id": "box_align",
          "options": [
            {
              "value": "top-left",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__1.label"
            },
            {
              "value": "top-center",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__2.label"
            },
            {
              "value": "top-right",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__3.label"
            },
            {
              "value": "middle-left",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__4.label"
            },
            {
              "value": "middle-center",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__5.label"
            },
            {
              "value": "middle-right",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__6.label"
            },
            {
              "value": "bottom-left",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__7.label"
            },
            {
              "value": "bottom-center",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__8.label"
            },
            {
              "value": "bottom-right",
              "label": "t:sections.slideshow.blocks.slide.settings.box_align.options__9.label"
            }
          ],
          "default": "middle-center",
          "label": "t:sections.slideshow.blocks.slide.settings.box_align.label",
          "info": "t:sections.slideshow.blocks.slide.settings.box_align.info"
        },
        {
          "type": "checkbox",
          "id": "show_text_box",
          "label": "t:sections.slideshow.blocks.slide.settings.show_text_box.label",
          "default": true
        },
        {
          "type": "select",
          "id": "text_alignment",
          "options": [
            {
              "value": "left",
              "label": "t:sections.slideshow.blocks.slide.settings.text_alignment.option_1.label"
            },
            {
              "value": "center",
              "label": "t:sections.slideshow.blocks.slide.settings.text_alignment.option_2.label"
            },
            {
              "value": "right",
              "label": "t:sections.slideshow.blocks.slide.settings.text_alignment.option_3.label"
            }
          ],
          "default": "center",
          "label": "t:sections.slideshow.blocks.slide.settings.text_alignment.label"
        },
        {
          "type": "range",
          "id": "image_overlay_opacity",
          "min": 0,
          "max": 100,
          "step": 10,
          "unit": "%",
          "label": "t:sections.slideshow.blocks.slide.settings.image_overlay_opacity.label",
          "default": 0
        },
        {
          "type": "select",
          "id": "color_scheme",
          "options": [
            {
              "value": "accent-1",
              "label": "t:sections.all.colors.accent_1.label"
            },
            {
              "value": "accent-2",
              "label": "t:sections.all.colors.accent_2.label"
            },
            {
              "value": "background-1",
              "label": "t:sections.all.colors.background_1.label"
            },
            {
              "value": "background-2",
              "label": "t:sections.all.colors.background_2.label"
            },
            {
              "value": "inverse",
              "label": "t:sections.all.colors.inverse.label"
            }
          ],
          "default": "background-1",
          "label": "t:sections.all.colors.label",
          "info": "t:sections.slideshow.blocks.slide.settings.color_scheme.info"
        },
        {
          "type": "header",
          "content": "t:sections.slideshow.settings.mobile.content"
        },
        {
          "type": "select",
          "id": "text_alignment_mobile",
          "options": [
            {
              "value": "left",
              "label": "t:sections.slideshow.blocks.slide.settings.text_alignment_mobile.options__1.label"
            },
            {
              "value": "center",
              "label": "t:sections.slideshow.blocks.slide.settings.text_alignment_mobile.options__2.label"
            },
            {
              "value": "right",
              "label": "t:sections.slideshow.blocks.slide.settings.text_alignment_mobile.options__3.label"
            }
          ],
          "default": "center",
          "label": "t:sections.slideshow.blocks.slide.settings.text_alignment_mobile.label"
        }
      ]
    }
  ],
  "presets": [
    {
      "name": "t:sections.slideshow.presets.name",
      "blocks": [
        {
          "type": "slide"
        },
        {
          "type": "slide"
        }
      ]
    }
  ]
}
{% endschema %} 
EOD,

'assets/section-image-banner.css' => <<<EOD
    .banner {
        display: flex;
        position: relative;
        flex-direction: column;
    }
    
    .banner__box {
        text-align: center;
    }
    
    @media only screen and (max-width: 749px) {
        .banner--content-align-mobile-right .banner__box {
        text-align: right;
        }
    
        .banner--content-align-mobile-left .banner__box {
        text-align: left;
        }
    }
    
    @media only screen and (min-width: 750px) {
        .banner--content-align-right .banner__box {
        text-align: right;
        }
    
        .banner--content-align-left .banner__box {
        text-align: left;
        }
    
        .banner--content-align-left.banner--desktop-transparent .banner__box,
        .banner--content-align-right.banner--desktop-transparent .banner__box,
        .banner--medium.banner--desktop-transparent .banner__box {
        max-width: 68rem;
        }
    }
    
    @media screen and (max-width: 749px) {
        .banner--small.banner--mobile-bottom:not(.banner--adapt) .banner__media,
        .banner--small.banner--stacked:not(.banner--mobile-bottom):not(.banner--adapt) > .banner__media {
        height: 28rem;
        }
    
        .banner--adapt--placeholder.banner--mobile-bottom .banner__media{
        min-height: 25rem;
        }
    
        .banner--medium.banner--mobile-bottom:not(.banner--adapt) .banner__media,
        .banner--medium.banner--stacked:not(.banner--mobile-bottom):not(.banner--adapt) > .banner__media {
        height: 34rem;
        }
    
        .banner--large.banner--mobile-bottom:not(.banner--adapt) .banner__media,
        .banner--large.banner--stacked:not(.banner--mobile-bottom):not(.banner--adapt) > .banner__media {
        height: 39rem;
        }
    
        .banner--small:not(.banner--mobile-bottom):not(.banner--adapt) .banner__content {
        min-height: 28rem;
        }
    
        .banner--medium:not(.banner--mobile-bottom):not(.banner--adapt) .banner__content {
        min-height: 34rem;
        }
    
        .banner--large:not(.banner--mobile-bottom):not(.banner--adapt) .banner__content {
        min-height: 39rem;
        }
    }
    
    @media screen and (min-width: 750px) {
        .banner {
        flex-direction: row;
        }
    
        .banner--small:not(.banner--adapt) {
        min-height: 42rem;
        }
    
        .banner--adapt--placeholder {
        min-height: 42rem;
        }
    
        .banner--medium:not(.banner--adapt) {
        min-height: 56rem;
        }
    
        .banner--large:not(.banner--adapt) {
        min-height: 72rem;
        }
    
        .banner__content.banner__content--top-left {
        align-items: flex-start;
        justify-content: flex-start;
        }
    
        .banner__content.banner__content--top-center {
        align-items: flex-start;
        justify-content: center;
        }
    
        .banner__content.banner__content--top-right {
        align-items: flex-start;
        justify-content: flex-end;
        }
    
        .banner__content.banner__content--middle-left {
        align-items: center;
        justify-content: flex-start;
        }
    
        .banner__content.banner__content--middle-center {
        align-items: center;
        justify-content: center;
        }
    
        .banner__content.banner__content--middle-right {
        align-items: center;
        justify-content: flex-end;
        }
    
        .banner__content.banner__content--bottom-left {
        align-items: flex-end;
        justify-content: flex-start;
        }
    
        .banner__content.banner__content--bottom-center {
        align-items: flex-end;
        justify-content: center;
        }
    
        .banner__content.banner__content--bottom-right {
        align-items: flex-end;
        justify-content: flex-end;
        }
    }
    
    @media screen and (max-width: 749px) {
        .banner:not(.banner--stacked) {
        flex-direction: row;
        flex-wrap: wrap;
        }
    
        .banner--stacked {
        height: auto;
        }
    
        .banner--stacked .banner__media {
        flex-direction: column;
        }
    }
    
    .banner__media {
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    
    .banner__media-half {
        width: 50%;
    }
    
    .banner__media-half + .banner__media-half {
        right: 0;
        left: auto;
    }
    
    @media screen and (max-width: 749px) {
        .banner--stacked .banner__media-half {
        width: 100%;
        }
    
        .banner--stacked .banner__media-half + .banner__media-half {
        order: 1;
        }
    }
    
    @media screen and (min-width: 750px) {
        .banner__media {
        height: 100%;
        }
    }
    
    .banner--adapt,
    .banner--adapt_image.banner--mobile-bottom .banner__media:not(.placeholder) {
        height: auto;
    }
    
    @media screen and (max-width: 749px) {
        .banner--mobile-bottom .banner__media,
        .banner--stacked:not(.banner--mobile-bottom) .banner__media {
        position: relative;
        }
    
        .banner--stacked.banner--adapt .banner__content {
        height: auto;
        }
        
        .banner:not(.banner--mobile-bottom):not(.email-signup-banner):not(.banner-content-inherit) .banner__box{
        background: transparent;
        --color-foreground: 255, 255, 255;
        --color-button: 255, 255, 255;
        --color-button-text: 0, 0, 0;
        }
    
        .banner:not(.banner--mobile-bottom) .banner__box {
        border: none;
        border-radius: 0;
        box-shadow: none;
        }
    
        .banner:not(.banner--mobile-bottom) .button--secondary {
        --color-button: 255, 255, 255;
        --color-button-text: 255, 255, 255;
        --alpha-button-background: 0;
        }
    
        .banner--stacked:not(.banner--mobile-bottom):not(.banner--adapt)
        .banner__content {
        position: absolute;
        height: auto;
        }
    
        .banner--stacked.banner--adapt:not(.banner--mobile-bottom) .banner__content {
        max-height: 100%;
        overflow: hidden;
        position: absolute;
        }
    
        .banner--stacked:not(.banner--adapt) .banner__media {
        position: relative;
        }
    
        .banner::before {
        display: none !important;
        }
    
        .banner--stacked .banner__media-image-half {
        width: 100%;
        }
    }
    
    .banner__content {
        padding: 0;
        display: flex;
        position: relative;
        width: 100%;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
    
    @media screen and (min-width: 750px) {
        .banner__content {
        padding: 5rem;
        }
    
        .banner__content--top-left {
        align-items: flex-start;
        justify-content: flex-start;
        }
    
        .banner__content--top-center {
        align-items: flex-start;
        justify-content: center;
        }
    
        .banner__content--top-right {
        align-items: flex-start;
        justify-content: flex-end;
        }
    
        .banner__content--middle-left {
        align-items: center;
        justify-content: flex-start;
        }
    
        .banner__content--middle-center {
        align-items: center;
        justify-content: center;
        }
    
        .banner__content--middle-right {
        align-items: center;
        justify-content: flex-end;
        }
    
        .banner__content--bottom-left {
        align-items: flex-end;
        justify-content: flex-start;
        }
    
        .banner__content--bottom-center {
        align-items: flex-end;
        justify-content: center;
        }
    
        .banner__content--bottom-right {
        align-items: flex-end;
        justify-content: flex-end;
        }
    }
    
    /* If Position of content on mobile if not below images : Inherit*/
    @media screen and (max-width: 750px) {
        slideshow-component.content-inherit .banner--desktop-transparent .banner__box {
        background: transparent;
        --color-foreground: 255, 255, 255;
        --color-button: 255, 255, 255;
        --color-button-text: 0, 0, 0;
        border: none;
        border-radius: 0;
        box-shadow: none;
        }
    }
    @media screen and (max-width: 749px) {
        slideshow-component.content-inherit .banner__content:not(.banner--desktop-transparent) {
        padding: 1rem;
        }
        
        slideshow-component.content-inherit .banner__content--top-left {
        align-items: flex-start;
        justify-content: flex-start;
        }
    
        slideshow-component.content-inherit .banner__content--top-center {
        align-items: flex-start;
        justify-content: center;
        }
    
        slideshow-component.content-inherit .banner__content--top-right {
        align-items: flex-start;
        justify-content: flex-end;
        }
    
        slideshow-component.content-inherit .banner__content--middle-left {
        align-items: center;
        justify-content: flex-start;
        }
    
        slideshow-component.content-inherit .banner__content--middle-center {
        align-items: center;
        justify-content: center;
        }
    
        slideshow-component.content-inherit .banner__content--middle-right {
        align-items: center;
        justify-content: flex-end;
        }
    
        slideshow-component.content-inherit .banner__content--bottom-left {
        align-items: flex-end;
        justify-content: flex-start;
        }
    
        slideshow-component.content-inherit .banner__content--bottom-center {
        align-items: flex-end;
        justify-content: center;
        }
    
        slideshow-component.content-inherit .banner__content--bottom-right {
        align-items: flex-end;
        justify-content: flex-end;
        }
    }
    
    @media screen and (max-width: 749px) {
        .banner--mobile-bottom:not(.banner--stacked) .banner__content {
        order: 2;
        }
    
        .banner:not(.banner--mobile-bottom) .field__input {
        background-color: transparent;
        }
    }
    
    .banner__box {
        padding: 4rem 3.5rem;
        position: relative;
        height: fit-content;
        align-items: center;
        text-align: center;
        width: 100%;
        word-wrap: break-word;
        z-index: 1;
    }
    
    .banner__box.content-container:after{
        display: none;
    }
    
    .banner__box.content-container:empty{
        display: none;
    }
    @media screen and (min-width: 750px) {
        .banner--desktop-transparent .banner__box {
        background: transparent;
        --color-foreground: 255, 255, 255;
        --color-button: 255, 255, 255;
        --color-button-text: 0, 0, 0;
        max-width: 89rem;
        border: none;
        border-radius: 0;
        box-shadow: none;
        }
    
        .banner--desktop-transparent .button--secondary {
        --color-button: 255, 255, 255;
        --color-button-text: 255, 255, 255;
        --alpha-button-background: 0;
        }
    
        .banner--desktop-transparent .content-container:after {
        display: none;
        }
    }
    
    @media screen and (max-width: 749px) {
        .banner--mobile-bottom::after,
        .banner--mobile-bottom .banner__media::after {
        display: none;
        }
    }
    
    .banner::after,
    .banner__media::after {
        content: '';
        position: absolute;
        top: 0;
        background: #000000;
        opacity: 0;
        z-index: 1;
        width: 100%;
        height: 100%;
    }
    
    .banner__box > * + .banner__text {
        margin-top: 1.5rem;
    }
    
    @media screen and (min-width: 750px) {
        .banner__box > * + .banner__text {
        margin-top: 2rem;
        }
    }
    
    .banner__box > * + * {
        margin-top: 1rem;
    }
    
    .banner__box > *:first-child {
        margin-top: 0;
    }
    
    @media screen and (max-width: 749px) {
        .banner--stacked .banner__box {
        width: 100%;
        }
    }
    
    @media screen and (min-width: 750px) {
        .banner__box {
        width: auto;
        max-width: 71rem;
        min-width: 45rem;
        }
    }
    
    @media screen and (min-width: 1400px) {
        .banner__box {
        max-width: 90rem;
        }
    }
    
    .banner__heading {
        margin-bottom: 0;
    }
    
    .banner__box .banner__heading + * {
        margin-top: 1rem;
    }
    
    .banner__buttons {
        display: inline-flex;
        flex-wrap: wrap;
        gap: 1rem;
        max-width: 45rem;
        word-break: break-word;
    }
    
    @media screen and (max-width: 749px) {
        .banner--content-align-mobile-right .banner__buttons--multiple {
        justify-content: flex-end;
        }
    
        .banner--content-align-mobile-center .banner__buttons--multiple > * {
        flex-grow: 1;
        min-width: 22rem;
        }
    }
    
    @media screen and (min-width: 750px) {
        .banner--content-align-center .banner__buttons--multiple > * {
        flex-grow: 1;
        min-width: 22rem;
        }
    
        .banner--content-align-right .banner__buttons--multiple {
        justify-content: flex-end;
        }
    }
    
    .banner__box > * + .banner__buttons {
        margin-top: 2rem;
    }
    
    @media screen and (max-width: 749px) {
        .banner:not(.slideshow) .rte a,
        .banner:not(.slideshow) .inline-richtext a:hover,
        .banner:not(.slideshow) .rte a:hover {
        color: currentColor;
        }
    }
    
    @media screen and (min-width: 750px) {
        .banner--desktop-transparent .rte a,
        .banner--desktop-transparent .inline-richtext a:hover,
        .banner--desktop-transparent .rte a:hover {
        color: currentColor;
        }
    }
 EOD,

'assets/component-slider.css' => <<<EOD
        slider-component {
            --desktop-margin-left-first-item: max(5rem, calc((100vw - var(--page-width) + 10rem - var(--grid-desktop-horizontal-spacing)) / 2));
            position: relative;
            display: block;
        }
        
        slider-component.slider-component-full-width {
            --desktop-margin-left-first-item: 1.5rem;
        }
        
        @media screen and (max-width: 749px) {
            slider-component.page-width {
            padding: 0 1.5rem;
            }
        }
        
        @media screen and (min-width: 749px) and (max-width: 990px) {
            slider-component.page-width {
            padding: 0 5rem;
            }
        }
        
        @media screen and (max-width: 989px) {
            .no-js slider-component .slider {
            padding-bottom: 3rem;
            }
        }
        
        .slider__slide {
            --focus-outline-padding: 0.5rem;
            --shadow-padding-top: calc((var(--shadow-vertical-offset) * -1 + var(--shadow-blur-radius)) * var(--shadow-visible));
            --shadow-padding-bottom: calc((var(--shadow-vertical-offset) + var(--shadow-blur-radius)) * var(--shadow-visible));
            scroll-snap-align: start;
            flex-shrink: 0;
            padding-bottom: 0;
        }
        
        @media screen and (max-width: 749px) {
            .slider.slider--mobile {
            position: relative;
            flex-wrap: inherit;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            scroll-padding-left: 1.5rem;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 1rem;
            }
        
            /* Fix to show some space at the end of our sliders in all browsers */
            .slider--mobile:after {
            content: "";
            width: 0;
            padding-left: 1.5rem;
            }
        
            .slider.slider--mobile .slider__slide {
            margin-bottom: 0;
            padding-top: max(var(--focus-outline-padding), var(--shadow-padding-top));
            padding-bottom: max(var(--focus-outline-padding), var(--shadow-padding-bottom));
            }
        
            .slider.slider--mobile.contains-card--standard .slider__slide:not(.collection-list__item--no-media) {
            padding-bottom: var(--focus-outline-padding);
            }
        
            .slider.slider--mobile.contains-content-container .slider__slide {
            --focus-outline-padding: 0rem;
            }
        }
        
        @media screen and (min-width: 750px) {
            .slider.slider--tablet-up {
            position: relative;
            flex-wrap: inherit;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            scroll-padding-left: 1rem;
            -webkit-overflow-scrolling: touch;
            }
        
            .slider.slider--tablet-up .slider__slide {
            margin-bottom: 0;
            }
        }
        
        @media screen and (max-width: 989px) {
            .slider.slider--tablet {
            position: relative;
            flex-wrap: inherit;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            scroll-padding-left: 1.5rem;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 1rem;
            }
        
            /* Fix to show some space at the end of our sliders in all browsers */
            .slider--tablet:after {
            content: "";
            width: 0;
            padding-left: 1.5rem;
            margin-left: calc(-1 * var(--grid-desktop-horizontal-spacing));
            }
        
            .slider.slider--tablet .slider__slide {
            margin-bottom: 0;
            padding-top: max(var(--focus-outline-padding), var(--shadow-padding-top));
            padding-bottom: max(var(--focus-outline-padding), var(--shadow-padding-bottom));
            }
        
            .slider.slider--tablet.contains-card--standard .slider__slide:not(.collection-list__item--no-media) {
            padding-bottom: var(--focus-outline-padding);
            }
        
            .slider.slider--tablet.contains-content-container .slider__slide {
            --focus-outline-padding: 0rem;
            }
        }
        
        .slider--everywhere {
            position: relative;
            flex-wrap: inherit;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 1rem;
        }
        
        .slider.slider--everywhere .slider__slide {
            margin-bottom: 0;
            scroll-snap-align: center;
        }
        
        @media screen and (min-width: 990px) {
            .slider-component-desktop.page-width {
            max-width: none;
            }
        
            .slider--desktop {
            position: relative;
            flex-wrap: inherit;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 1rem;
            scroll-padding-left: var(--desktop-margin-left-first-item);
            }
        
            /* Fix to show some space at the end of our sliders in all browsers */
            .slider--desktop:after {
            content: "";
            width: 0;
            padding-left: 5rem;
            margin-left: calc(-1 * var(--grid-desktop-horizontal-spacing));
            }
        
            .slider.slider--desktop .slider__slide {
            margin-bottom: 0;
            padding-top: max(var(--focus-outline-padding), var(--shadow-padding-top));
            padding-bottom: max(var(--focus-outline-padding), var(--shadow-padding-bottom));
            }
        
            .slider--desktop .slider__slide:first-child {
            margin-left: var(--desktop-margin-left-first-item);
            scroll-margin-left: var(--desktop-margin-left-first-item);
            }
        
            .slider-component-full-width .slider--desktop {
            scroll-padding-left: 1.5rem;
            }
        
            .slider-component-full-width .slider--desktop .slider__slide:first-child {
            margin-left: 1.5rem;
            scroll-margin-left: 1.5rem;
            }
        
            /* Fix to show some space at the end of our sliders in all browsers */
            .slider-component-full-width .slider--desktop:after {
            padding-left: 1.5rem;
            }
        
            .slider--desktop.grid--5-col-desktop .grid__item {
            width: calc( (100% - var(--desktop-margin-left-first-item)) / 5 - var(--grid-desktop-horizontal-spacing) * 2);
            }
        
            .slider--desktop.grid--4-col-desktop .grid__item {
            width: calc( (100% - var(--desktop-margin-left-first-item)) / 4 - var(--grid-desktop-horizontal-spacing) * 3);
            }
        
            .slider--desktop.grid--3-col-desktop .grid__item {
            width: calc( (100% - var(--desktop-margin-left-first-item)) / 3 - var(--grid-desktop-horizontal-spacing) * 4);
            }
        
            .slider--desktop.grid--2-col-desktop .grid__item {
            width: calc( (100% - var(--desktop-margin-left-first-item)) / 2 - var(--grid-desktop-horizontal-spacing) * 5);
            }
        
            .slider--desktop.grid--1-col-desktop .grid__item {
            width: calc( (100% - var(--desktop-margin-left-first-item)) - var(--grid-desktop-horizontal-spacing) * 9);
            }
        
            .slider.slider--desktop.contains-card--standard .slider__slide:not(.collection-list__item--no-media) {
            padding-bottom: var(--focus-outline-padding);
            }
        
            .slider.slider--desktop.contains-content-container .slider__slide {
            --focus-outline-padding: 0rem;
            }
        }
        
        @media (prefers-reduced-motion) {
            .slider {
            scroll-behavior: auto;
            }
        }
        
        /* Scrollbar */
        
        .slider {
            scrollbar-color: rgb(var(--color-foreground)) rgba(var(--color-foreground), 0.04);
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .slider::-webkit-scrollbar {
            height: 0.4rem;
            width: 0.4rem;
            display: none;
        }
        
        .no-js .slider {
            -ms-overflow-style: auto;
            scrollbar-width: auto;
        }
        
        .no-js .slider::-webkit-scrollbar {
            display: initial;
        }
        
        .slider::-webkit-scrollbar-thumb {
            background-color: rgb(var(--color-foreground));
            border-radius: 0.4rem;
            border: 0;
        }
        
        .slider::-webkit-scrollbar-track {
            background: rgba(var(--color-foreground), 0.04);
            border-radius: 0.4rem;
        }
        
        .slider-counter {
            display: flex;
            justify-content: center;
            min-width: 4.4rem;
        }
        
        @media screen and (min-width: 750px) {
            .slider-counter--dots {
            margin: 0 1.2rem;
            }
        }
        
        .slider-counter__link {
            padding: 1rem;
        }
        
        @media screen and (max-width: 749px) {
            .slider-counter__link {
            padding: 0.7rem;
            }
        }
        
        .slider-counter__link--dots .dot {
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            border: 0.1rem solid rgba(var(--color-foreground), 0.5);
            padding: 0;
            display: block;
        }
        
        .slider-counter__link--active.slider-counter__link--dots .dot {
            background-color: rgb(var(--color-foreground));
        }
        
        @media screen and (forced-colors: active) {
            .slider-counter__link--active.slider-counter__link--dots .dot {
            background-color: CanvasText;
            }
        }
        
        .slider-counter__link--dots:not(.slider-counter__link--active):hover .dot {
            border-color: rgb(var(--color-foreground));
        }
        
        .slider-counter__link--dots .dot,
        .slider-counter__link--numbers {
            transition: transform 0.2s ease-in-out;
        }
        
        .slider-counter__link--active.slider-counter__link--numbers,
        .slider-counter__link--dots:not(.slider-counter__link--active):hover .dot,
        .slider-counter__link--numbers:hover {
            transform: scale(1.1);
        }
        
        .slider-counter__link--numbers {
            color: rgba(var(--color-foreground), 0.5);
            text-decoration: none;
        }
        
        .slider-counter__link--numbers:hover {
            color: rgb(var(--color-foreground));
        }
        
        .slider-counter__link--active.slider-counter__link--numbers {
            text-decoration: underline;
            color: rgb(var(--color-foreground));
        }
        
        .slider-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        @media screen and (min-width: 990px) {
            .slider:not(.slider--everywhere):not(.slider--desktop) + .slider-buttons {
            display: none;
            }
        }
        
        @media screen and (max-width: 989px) {
            .slider--desktop:not(.slider--tablet) + .slider-buttons {
            display: none;
            }
        }
        
        @media screen and (min-width: 750px) {
            .slider--mobile + .slider-buttons {
            display: none;
            }
        }
        
        .slider-button {
            color: rgba(var(--color-foreground), 0.75);
            background: transparent;
            border: none;
            cursor: pointer;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .slider-button:not([disabled]):hover {
            color: rgb(var(--color-foreground));
        }
        
        .slider-button .icon {
            height: 0.6rem;
        }
        
        .slider-button[disabled] .icon {
            color: rgba(var(--color-foreground), 0.3);
            cursor: not-allowed;
        }
        
        .slider-button--next .icon {
            transform: rotate(-90deg);
        }
        
        .slider-button--prev .icon {
            transform: rotate(90deg);
        }
        
        .slider-button--next:not([disabled]):hover .icon {
            transform: rotate(-90deg) scale(1.1);
        }
        
        .slider-button--prev:not([disabled]):hover .icon {
            transform: rotate(90deg) scale(1.1);
        }
    EOD,
    'assets/component-slideshow.css' => <<<EOD
        slideshow-component {
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        @media screen and (max-width: 989px) {
            .no-js slideshow-component .slider {
            padding-bottom: 3rem;
            }
        }
        
        slideshow-component .slideshow.banner {
            flex-direction: row;
            flex-wrap: nowrap;
            margin: 0;
            gap: 0;
        }
        
        .slideshow__slide {
            padding: 0;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        @media screen and (max-width: 749px) {
            .slideshow--placeholder.banner--mobile-bottom.banner--adapt_image .slideshow__media,
            .slideshow--placeholder.banner--adapt_image:not(.banner--mobile-bottom) {
            height: 28rem;
            }
            .slideshow__text-wrapper.empty .banner__box {
            padding: 0px!important;
            }
            .slider-counter__link--dots .dot {
            width: 0.7rem;
            height: 0.7rem;
            }
        }
        
        @media screen and (min-width: 750px) {
            .slideshow--placeholder.banner--adapt_image {
            height: 56rem;
            }
        }
        
        .slideshow__text.banner__box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 54.5rem;
        }
        
        .slideshow__text > * {
            max-width: 100%;
        }
        
        @media screen and (max-width: 749px) {
            slideshow-component.page-width .slideshow__text {
            border-right: var(--text-boxes-border-width) solid rgba(var(--color-foreground), var(--text-boxes-border-opacity));
            border-left: var(--text-boxes-border-width) solid rgba(var(--color-foreground), var(--text-boxes-border-opacity));
            }
        
            .banner--mobile-bottom .slideshow__text.banner__box {
            max-width: 100%;
            }
        
            .banner--mobile-bottom .slideshow__text-wrapper {
            flex-grow: 1;
            }
        
            .banner--mobile-bottom .slideshow__text.banner__box {
            height: 100%;
            }
        
            .banner--mobile-bottom .slideshow__text .button {
            flex-grow: 0;
            }
        
            .slideshow__text.slideshow__text-mobile--left {
            align-items: flex-start;
            text-align: left;
            }
        
            .slideshow__text.slideshow__text-mobile--right {
            align-items: flex-end;
            text-align: right;
            }
        }
        
        @media screen and (min-width: 750px) {
            .slideshow__text.slideshow__text--left {
            align-items: flex-start;
            text-align: left;
            }
        
            .slideshow__text.slideshow__text--right {
            align-items: flex-end;
            text-align: right;
            }
        }
        
        
        .slideshow:not(.banner--mobile-bottom) .slideshow__text-wrapper {
            height: 100%;
        }
        
        @media screen and (min-width: 750px) {
            .slideshow__text-wrapper.banner__content {
            height: 100%;
            padding: 5rem;
            }
        }
        
        .slideshow__controls {
            border: 0rem solid rgba(var(--color-foreground), 0.08);
        }
        
        .slideshow__controls--top {
            order: 2;
            z-index: 3;
        }
        
        @media screen and (max-width: 749px) {
            .slideshow__controls--border-radius-mobile {
            border-bottom-right-radius: var(--text-boxes-radius);
            border-bottom-left-radius: var(--text-boxes-radius);
            }
        }
        
        .spaced-section--full-width:last-child slideshow-component:not(.page-width) .slideshow__controls {
            border-bottom: none;
        }
        
        @media screen and (min-width: 750px) {
            .slideshow__controls {
            position: relative;
            margin-top: -60px;
            margin-bottom: 15px;
            z-index: 3;
            }
        }
        
        slideshow-component:not(.page-width) .slider-buttons {
            border-right: 0;
            border-left: 0;
        }
        
        .slideshow__control-wrapper {
            display: flex;
        }
        
        .slideshow__autoplay {
            position: absolute;
            right: 0;
            border-left: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        @media screen and (max-width: 749px) {
            slideshow-component.page-width .slideshow__autoplay {
            right: 1.5rem;
            }
        }
        
        @media screen and (min-width: 750px) {
            .slideshow__autoplay.slider-button {
            position: inherit;
            margin-left: 0.6rem;
            padding: 0 0 0 0.6rem;
            border-left: 0.1rem solid rgba(var(--color-foreground), 0.08);
            }
        }
        
        .slideshow__autoplay .icon.icon-play,
        .slideshow__autoplay .icon.icon-pause {
            display: block;
            position: absolute;
            opacity: 1;
            transform: scale(1);
            transition: transform 150ms ease, opacity 150ms ease;
            width: 0.8rem;
            height: 1.2rem;
        }
        
        .slideshow__autoplay .icon.icon-play {
            height: 1rem;
        }
        
        .slideshow__autoplay path {
            fill: rgba(var(--color-foreground), 0.75);
        }
        
        .slideshow__autoplay:hover path {
            fill: rgb(var(--color-foreground));
        }
        
        @media screen and (forced-colors: active) {
            .slideshow__autoplay path,
            .slideshow__autoplay:hover path{
            fill: CanvasText;
            }
        }
        
        .slideshow__autoplay:hover svg {
            transform: scale(1.1);
        }
        
        .slideshow__autoplay--paused .icon-pause,
        .slideshow__autoplay:not(.slideshow__autoplay--paused) .icon-play {
            visibility: hidden;
            opacity: 0;
            transform: scale(.8)
        }
        
        /* If Position of content on mobile if not below images : Inherit*/
        @media screen and (max-width: 749px) {
            slideshow-component.content-inherit .slideshow__text.banner__box {
            max-width: 55%;
            padding: 1rem 1rem;
            }
            slideshow-component.content-inherit .slideshow__text h2.banner__heading{
            font-size: 3vw;
            margin-top: 0!important;
            }
            slideshow-component.content-inherit .slideshow__text .banner__text {
            font-size: 1.8vw;
            margin-top: 1vw!important;
            }
            slideshow-component.content-inherit .slideshow__text .banner__buttons {
            margin-top: 2vw!important;
            }
            slideshow-component.content-inherit .slideshow__text .banner__buttons a{
            min-width: auto;
            min-height: auto;
            padding: 2vw 3vw;
            font-size: 1.8vw;
            }
        }
    EOD,

];

// Write the content to the respective theme files
foreach ($theme_files as $file_path => $content) {
    $fullPath = $theme_base_path . '/' . $file_path;
    file_put_contents($fullPath, $content);
}

// Generate a random number for the ZIP file name
$random_number = rand(1000, 9999);

// Define the path for the ZIP file with a random number
$zip_file_path = "D:/xampp/htdocs/theme-generator/themes/manhattan-test-generated-{$random_number}.zip";

// Create the ZIP archive
$zip = new ZipArchive();
if ($zip->open($zip_file_path, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    // Add theme files and directories to the ZIP archive
    addFilesToZip($theme_base_path, $zip, $theme_base_path);
    $zip->close();
    echo "Shopify theme created and zipped successfully at " . $zip_file_path;

    // Empty the theme base path after ZIP creation
    $files = glob($theme_base_path . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
} else {
    echo "Failed to create ZIP file.";
}
?>
