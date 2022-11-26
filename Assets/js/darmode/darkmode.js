(function ($) {
    'use strict'

  
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1)
    }
  
    function createSkinBlock(colors, callback, noneSelected) {
      var $block = $('<select />', {
        class: noneSelected ? 'custom-select mb-3 border-0' : 'custom-select mb-3 text-light border-0 ' + colors[0].replace(/accent-|navbar-/, 'bg-')
      })
  
      if (noneSelected) {
        var $default = $('<option />', {
          text: 'None Selected'
        })
  
        $block.append($default)
      }
  
      colors.forEach(function (color) {
        var $color = $('<option />', {
          class: (typeof color === 'object' ? color.join(' ') : color).replace('navbar-', 'bg-').replace('accent-', 'bg-'),
          text: capitalizeFirstLetter((typeof color === 'object' ? color.join(' ') : color).replace(/navbar-|accent-|bg-/, '').replace('-', ' '))
        })
  
        $block.append($color)
      })
      if (callback) {
        $block.on('change', callback)
      }
  
      return $block
    }
  
    var $sidebar = $('.control-sidebar')
    var $container = $('<div />', {
      class: 'p-3 control-sidebar-content'
    })
  
    $sidebar.append($container)
  
    // Checkboxes
  
    $container.append(
      '<h5>Customize AdminLTE</h5><hr class="mb-2"/>'
    )
  
    var $dark_mode_checkbox = $('<input />', {
      type: 'checkbox',
      value: 1,
      checked: $('body').hasClass('dark-mode'),
      class: 'mr-1'
    }).on('click', function () {
      if ($(this).is(':checked')) {
        $('body').addClass('dark-mode')
      } else {
        $('body').removeClass('dark-mode')
      }
    })
    var $dark_mode_container = $('<div />', { class: 'mb-4' }).append($dark_mode_checkbox).append('<span>Modo Oscuro</span>')
    $container.append($dark_mode_container)

    $container.append('<h6>Sidebar Options</h6>')
  
    var $sidebar_collapsed_checkbox = $('<input />', {
      type: 'checkbox',
      value: 1,
      checked: $('body').hasClass('sidebar-collapse'),
      class: 'mr-1'
    }).on('click', function () {
      if ($(this).is(':checked')) {
        $('body').addClass('sidebar-collapse')
        $(window).trigger('resize')
      } else {
        $('body').removeClass('sidebar-collapse')
        $(window).trigger('resize')
      }
    })
    var $sidebar_collapsed_container = $('<div />', { class: 'mb-1' }).append($sidebar_collapsed_checkbox).append('<span>Colapsar</span>')
    $container.append($sidebar_collapsed_container)
  
    $(document).on('collapsed.lte.pushmenu', '[data-widget="pushmenu"]', function () {
      $sidebar_collapsed_checkbox.prop('checked', true)
    })
    $(document).on('shown.lte.pushmenu', '[data-widget="pushmenu"]', function () {
      $sidebar_collapsed_checkbox.prop('checked', false)
    })
  
  
    var $flat_sidebar_checkbox = $('<input />', {
      type: 'checkbox',
      value: 1,
      checked: $('.nav-sidebar').hasClass('nav-flat'),
      class: 'mr-1'
    }).on('click', function () {
      if ($(this).is(':checked')) {
        $('.nav-sidebar').addClass('nav-flat')
      } else {
        $('.nav-sidebar').removeClass('nav-flat')
      }
    })
    var $flat_sidebar_container = $('<div />', { class: 'mb-1' }).append($flat_sidebar_checkbox).append('<span>Estilo Plano</span>')
    $container.append($flat_sidebar_container)
  
  
    var $child_indent_sidebar_checkbox = $('<input />', {
      type: 'checkbox',
      value: 1,
      checked: $('.nav-sidebar').hasClass('nav-child-indent'),
      class: 'mr-1'
    }).on('click', function () {
      if ($(this).is(':checked')) {
        $('.nav-sidebar').addClass('nav-child-indent')
      } else {
        $('.nav-sidebar').removeClass('nav-child-indent')
      }
    })
    var $child_indent_sidebar_container = $('<div />', { class: 'mb-1' }).append($child_indent_sidebar_checkbox).append('<span>Mostrar Decendencia</span>')
    $container.append($child_indent_sidebar_container)
  
    $container.append('<h6>Opciones de Footer</h6>')
    var $footer_fixed_checkbox = $('<input />', {
      type: 'checkbox',
      value: 1,
      checked: $('body').hasClass('layout-footer-fixed'),
      class: 'mr-1'
    }).on('click', function () {
      if ($(this).is(':checked')) {
        $('body').addClass('layout-footer-fixed')
      } else {
        $('body').removeClass('layout-footer-fixed')
      }
    })
    var $footer_fixed_container = $('<div />', { class: 'mb-4' }).append($footer_fixed_checkbox).append('<span>Fixed</span>')
    $container.append($footer_fixed_container)
  
  
    // Color Arrays
  
    var navbar_dark_skins = [
      'navbar-primary',
      'navbar-secondary',
      'navbar-info',
      'navbar-success',
      'navbar-danger',
      'navbar-indigo',
      'navbar-purple',
      'navbar-pink',
      'navbar-navy',
      'navbar-lightblue',
      'navbar-teal',
      'navbar-cyan',
      'navbar-dark',
      'navbar-gray-dark',
      'navbar-gray'
    ]
  
    var navbar_light_skins = [
      'navbar-light',
      'navbar-warning',
      'navbar-white',
      'navbar-orange'
    ]

    
  })(jQuery)
  