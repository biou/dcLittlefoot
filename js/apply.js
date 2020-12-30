document.addEventListener('DOMContentLoaded', function() {
  // hide some elements from the DOM and be able to parse Dotclear custom footnotes syntax
  Array.from(document.querySelectorAll('.footnotes h4')).forEach(function(e) {
    e.style.display = 'none'
  })
  Array.from(document.querySelectorAll('.footnotes p')).forEach(function(p) {
    if (p.childNodes[0].textContent === '[') {
      p.childNodes[0].textContent = ''
    }
    if (p.childNodes[2].textContent.charAt(0) == ']') {
      p.childNodes[2].textContent = p.childNodes[2].textContent.substring(1)
    }    
  })  
  const littlefoot_data = dotclear.getData('littlefoot');

  let littlefoot_options = {
    anchorPattern: /(fn|footnote|note|wiki-footnote)[:\-_\d]/gi,
    footnoteSelector: '.footnotes p',
    numberResetSelector: ".post",
    scope: ".post"
  };

  littlefoot_options.contentTemplate = '<div class="littlefoot__popover" id="fncontent:<% id %>"><div class="littlefoot__wrapper"><div class="littlefoot__content"><% content %></div></div><div class="littlefoot__tooltip"></div></div>'
  if (littlefoot_data.style == 'numeric') {
    littlefoot_options.buttonTemplate = '<button aria-label="'+littlefoot_data['i18n-footnote']+' <% number %>" class="littlefoot__button" id="<% reference %>" title="'+littlefoot_data['i18n-see-footnote']+' <% number %>" /><% number %></button>'
  } else {
    littlefoot_options.buttonTemplate = '<button class="littlefoot__button" id="<% reference %>" title="'+littlefoot_data['i18n-see-footnote']+' <% number %>"><svg role="img" aria-labelledby="title-<% reference %>" viewbox="0 0 31 6" preserveAspectRatio="xMidYMid"><title id="title-<% reference %>">'+littlefoot_data['i18n-footnote']+' <% number %></title><circle r="3" cx="3" cy="3" fill="white"></circle><circle r="3" cx="15" cy="3" fill="white"></circle><circle r="3" cx="27" cy="3" fill="white"></circle></svg></button>'
  }

  if (littlefoot_data.hover) {
    littlefoot_options.activateOnHover = true;
    littlefoot_options.dismissOnUnhover = true;
    littlefoot_options.hoverDelay = 500;
  }
  littlefoot.littlefoot(littlefoot_options);
})




