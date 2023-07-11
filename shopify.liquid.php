
<!-- nws-pdp-template -->
  <div class="nws-pdp-template" {% if section.settings.section-color != blank %}style="background-color:{{ section.settings.section-color }};"{% endif %} >
    <div class="container" >
      {% render 'kt_breadcrumb' %}
      <div class="nws-pdp-template-content row">
        <div class="col-lg-6 col-md-6 col-sm-12" >
          <div class="nws-pdp-template-gallery" >
            <div class="nws-pdp-template-oneImagePhoto clearfix">
             {% for image in product.images %}
               <div class="nws-pdp-slide-main" >
                 <div class="nws-pdp-slide" >
                   <img src="{{ image.src | product_img_url: '1000x' }}" width="100%" height="100%" alt="{{ image.alt }}" />
                 </div>
               </div>
             {% endfor %}
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12" >
          <div class="nws-pdp-template-form" >
            <div class="nws-pdp-template-info" >
              <h2 class="heading-nws" >{{ product.title }}</h2>
            </div>
            <form class="product-form product-form-product-template" method="post" action="/cart/add" data-productid="{{ product.id }}" id="product-form-{{ product.variants.first.id }}" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="novalidate" data-product-form="">
              <input type="hidden" name="form_type" value="product">
              <input type="hidden" name="utf8" value="✓">
              
              {%- assign current_variant = product.selected_or_first_available_variant -%}
              <div class="product__price">
                {% include 'nws-product-price', variant: current_variant, product: product %}
              </div>

              <div class="nws-description-item-short">{{ product.description | truncatewords: 32 }}</div>

                <select id="nws-variant-id" class="product-form__variants no-js d-none"  name="id" data-productid="{{ product.id }}"  >
                  {% for variant in product.variants %}
                    <option data-val="{{ variant.title }}" value="{{ variant.id }}" {%- if variant == current_variant %} selected="selected" {%- endif -%} >{{ variant.title }}  {%- if variant.available == false %} - {{ 'products.product.sold_out' | t }}{% endif %}</option>
                  {% endfor %}
                </select>
              
                <div class="nws-pdp-submit-div" >
                  {% if product.available %}
                    <input id="nws-pdp-submit" type="submit" value="BUY NOW" class="btn cls-chr nws-pdp-submit" />
                  {% else %}
                    <input type="button" value="Sold Out" class="btn nws-pdp-submit" disabled="disabled" />
                  {% endif %}
                </div>

               {% if section.settings.pdp-v-1 != blank or section.settings.pdp-v-2 != blank %}
                  <div class="nws-fake-selection" >
                      <label>Upgrade</label>
                      <div class="nws-fake-selection-ul" >
                        {% if section.settings.pdp-v-1 != blank %}
                          {% assign product1 = section.settings.pdp-vl-1 %}
                          <a href="{{ product1.url }}" class="nws-fake-selection-li {% if product1.handle == product.handle %}nws-fs-active{% endif %}" >
                            <div class="nws-fake-pdp-tl" >{{ section.settings.pdp-v-1 }}</div>
                            {%- assign current_variant = product1.selected_or_first_available_variant -%}
                            <div class="nws-fake-pdp-pr product__price" >{% include 'nws-product-price', variant: current_variant, product: product1 %}</div>
                          </a>
                        {% endif %}
                        {% if section.settings.pdp-v-2 != blank %}
                          {% assign product2 = section.settings.pdp-vl-2 %}
                          <a href="{{ product2.url }}" class="nws-fake-selection-li {% if product2.handle == product.handle %}nws-fs-active{% endif %}" >
                            <div class="nws-fake-pdp-tl" >{{ section.settings.pdp-v-2 }}</div>
                            {%- assign current_variant = product2.selected_or_first_available_variant -%}
                            <div class="nws-fake-pdp-pr product__price" >{% include 'nws-product-price', variant: current_variant, product: product2 %}</div>
                          </a>
                         {% endif %}
                      </div>
                      <div class="nws-whats-difference">
                         <a href="#" data-bs-toggle="modal" data-bs-target="#Modal-difference">What’s the difference?</a>
                       </div> 
                  </div>
                {% endif %}
            </form> 
            
            {% assign customLink = product.metafields.custom.description_video %}
            {% if customLink != blank or product.description != blank %}
              <div class="nws-pdp-template-description" >  
                <div class="nws-description-item">
                  <h3 class="nws-description-item-title">Description</h3>
                  <div class="nws-description-item-body">
                    <div class="nws-description-item-body-inner" >{{ product.description }}</div> 
                    {% if customLink != blank %}
                      {% assign clnLinkCheck = customLink | replace: "/"," "  %}
                      {% assign clnLink = customLink 
                        | replace: "https://youtu.be/","" 
                        | replace: "http://youtu.be/","" 
                        | replace: "https://www.youtube.com/watch?v=","" 
                        | replace: "http://www.youtube.com/watch?v=","" 
                        | replace: "https://youtube.com/watch?v=","" 
                        | replace: "http://youtube.com/watch?v=","" 
                        | replace: "https://www.vimeo.com/","" 
                        | replace: "https://vimeo.com/",""
                        | replace: "youtu.be/","" 
                        | replace: "www.youtube.com/watch?v=","" 
                        | replace: "youtube.com/watch?v=",""  
                        | replace: "www.vimeo.com/","" 
                        | replace: "vimeo.com/","" 
                      %}
                      <div class="nws-pdp-video-dp">
                        {% if clnLinkCheck contains "www.youtube.com" or clnLinkCheck contains "youtube.com" or clnLinkCheck contains "youtu.be" %}
                            <iframe src="//www.youtube.com/embed/{{ clnLink }}?modestbranding=0&fs=0&autohide=1&showinfo=0&rel=0" width="100%" height="260" frameborder="0" allowfullscreen></iframe>
                        {% endif %}
                        {% if clnLinkCheck contains "www.vimeo.com" or clnLinkCheck contains "vimeo.com" %}
                            <iframe src="//player.vimeo.com/video/{{ clnLink }}?color={{ settings.color_secondary | remove: "#" }}&byline=0&portrait=0&badge=0" width="100%" height="260" frameborder="0" allowfullscreen></iframe>
                        {% endif %}
                      </div>
                    {% endif %}
                  </div>
                </div>
              </div>
            {% endif %}
            {% if product.metafields.custom.features_benefits_list != blank %}
              <div class="nws-pdp-template-description nws-pdp-temp-desp" >  
                <div class="nws-description-item">
                  <h3 class="nws-description-item-title">Features & Benefits</h3>
                  <div class="nws-description-item-body nws-benefits-list">{{ product.metafields.custom.features_benefits_list }}</div>
                </div>
              </div>
            {% endif %}
            {% assign customLink = product.metafields.custom.works_video %}
            {% if customLink != blank or product.metafields.custom.how_it_works_text != blank  %}
              <div class="nws-pdp-template-description nws-pdp-temp-desp" >  
                <div class="nws-description-item">
                  <h3 class="nws-description-item-title">How it Works</h3>
                  <div class="nws-description-item-body">
                    <div class="nws-description-item-body-inner" >{{ product.metafields.custom.how_it_works_text | metafield_tag }}</div>
                    {% if customLink != blank %}
                      {% assign clnLinkCheck = customLink | replace: "/"," "  %}
                      {% assign clnLink = customLink 
                        | replace: "https://youtu.be/","" 
                        | replace: "http://youtu.be/","" 
                        | replace: "https://www.youtube.com/watch?v=","" 
                        | replace: "http://www.youtube.com/watch?v=","" 
                        | replace: "https://youtube.com/watch?v=","" 
                        | replace: "http://youtube.com/watch?v=","" 
                        | replace: "https://www.vimeo.com/","" 
                        | replace: "https://vimeo.com/",""
                        | replace: "youtu.be/","" 
                        | replace: "www.youtube.com/watch?v=","" 
                        | replace: "youtube.com/watch?v=",""  
                        | replace: "www.vimeo.com/","" 
                        | replace: "vimeo.com/","" 
                      %}
                      <div class="nws-pdp-video-dp">
                        {% if clnLinkCheck contains "www.youtube.com" or clnLinkCheck contains "youtube.com" or clnLinkCheck contains "youtu.be" %}
                            <iframe src="//www.youtube.com/embed/{{ clnLink }}?modestbranding=0&fs=0&autohide=1&showinfo=0&rel=0" width="100%" height="260" frameborder="0" allowfullscreen></iframe>
                        {% endif %}
                        {% if clnLinkCheck contains "www.vimeo.com" or clnLinkCheck contains "vimeo.com" %}
                            <iframe src="//player.vimeo.com/video/{{ clnLink }}?color={{ settings.color_secondary | remove: "#" }}&byline=0&portrait=0&badge=0" width="100%" height="260" frameborder="0" allowfullscreen></iframe>
                        {% endif %}
                      </div>
                    {% endif %}
                  </div>
                </div>
              </div>
            {% endif %}
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- end nws-pdp-template -->
{% schema %}
  {
    "name": "NWS - PDP Template",
    "settings": [
        {
          "type": "color",
          "id": "section-color",
          "label": "Section BG Color"
        },
        {
          "type": "text",
          "id": "pdp-v-1",
          "label": "Product Name"
        },
        {
          "type": "product",
          "id": "pdp-vl-1",
          "label": "Product Link"
        },
        {
          "type": "text",
          "id": "pdp-v-2",
          "label": "Product Name"
        },
        {
          "type": "product",
          "id": "pdp-vl-2",
          "label": "Product Link"
        }
    ],
    "blocks": [
    {
      "type": "Slide",
      "name": "Slide Item",
      "settings": [
      ]
    }
   ]
  }
{% endschema %}