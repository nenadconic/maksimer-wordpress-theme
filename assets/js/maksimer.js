jQuery(($) => {
  /**
   * Trigger variation changes on small sweet variation ul li click
   */
  $(document).on('click', '.sweet-variations .choose-variation', (event) => {
    event.preventDefault();
    const element = event.currentTarget;

    // Setup data attributes as const
    const attributes = $(element).data('variations');

    // Remove potential other active item and set clicked to active
    $(element).closest('.sweet-variations').find('.choose-variation.active-option').removeClass('active-option');
    $(element).addClass('active-option');

    $.each(attributes, (key, value) => {
      // Update core WooCommerce select input matching clicked attribute variation
      $(`#${key}`).val(value).change();
    });
  });


  /**
   * Trigger variation changes on large sweet variation ul li button click
   */
  $(document).on('click', '.sweet-variation-large .choose-variation', (event) => {
    event.preventDefault();
    const button = event.currentTarget;

    // Setup data attributes as const
    const attributes = $(button).data('variations');
    $.each(attributes, (key, value) => {
      // Update core WooCommerce select input matching clicked attribute variation
      $(`#${key}`).val(value).change();
    });
  });

  // Event triggered when variation / all variations if multiple is selected
  $('form.variations_form').on('show_variation', (event, variation) => {
    // Remove all active classes
    $('.choose-variation').removeClass('active-option');
    $('.sweet-variation-large').removeClass('active-option');

    $('.retail-price-container').replaceWith(variation.retail_price_html);

    /**
     * cssChecks is used to build up a string to select the correct single sweet variation larges
     */
    let cssChecks = '';

    $.each(variation.attributes, (key, value) => {
      // Get the correct small sweet variation
      const singleVariation = $('.sweet-variations').find(`.choose-variation[data-${key}=${value}]`);
      // Get image from the small sweet variation
      const termImage = $(singleVariation).data('term_image');
      // Get the name from the small sweet variation
      const termName = $(singleVariation).find('.variant-name').text();
      // Get the relevant sweet variation opener button
      const currentButton = $(`.open-variations[data-${key}="true"]`);

      // Replace image in the relevant sweet variation opener button
      if (typeof termImage !== 'undefined') {
        $(currentButton).find('.button-image img').attr('src', termImage);
      }

      // Replace name in the relevant sweet variation opener button
      $(currentButton).find('.button-name').html(termName);

      // Add class to the currently active small sweet variation
      $(singleVariation).addClass('active-option');


      // Add to the cssChecks string
      cssChecks = `${cssChecks}[data-${key}="${value}"]`;
    });

    // Get the relevant large sweet variation
    const singleVariationLarge = $(`.choose-variation-large${cssChecks}`);

    // Add class to the relevant large sweet variation
    $(singleVariationLarge).closest('.sweet-variation-large').addClass('active-option');
  });


  /**
   * Handle toggling of sweet variation dropdown on button click
   */
  $(document).on('click', '.open-variations', (event) => {
    event.preventDefault();
    const element = event.currentTarget;
    const attribute = $(element).data('attribute');
    $(element).toggleClass('variations-open');
    $(element).closest('.single_variation_wrap').find(`.sweet-variation-dropdown[data-attribute="${attribute}"]`).slideToggle();
  });

  /**
   * Scroll to add to cart container on large variation select
   */
  $(document).on('click', '.choose-variation-large', () => {
    if ($(window).width() < 1022) {
      $('html, body').animate(
        {
          scrollTop: $('.sweet-variations-outer').offset().top,
        },
        1000,
      );
    }
  });
});
