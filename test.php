<?php

// Your Liquid content
$liquidContent = <<<EOD
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
EOD;

// Write the Liquid content to a .liquid file
$file = fopen("generated_template.liquid", "w");
fwrite($file, $liquidContent);
fclose($file);

echo "Liquid file generated successfully!";
?>
