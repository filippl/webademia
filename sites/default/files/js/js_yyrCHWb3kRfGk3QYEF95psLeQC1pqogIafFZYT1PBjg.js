Drupal.locale = { 'pluralFormula': function ($n) { return Number((($n==1)?(0):((((($n%10)>=2)&&(($n%10)<=4))&&((($n%100)<10)||(($n%100)>=20)))?(1):2))); }, 'strings': {"":{"Edit":"Edytuj","An AJAX HTTP error occurred.":"Wyst\u0105pi\u0142 b\u0142\u0105d w AJAX HTTP.","HTTP Result Code: !status":"B\u0142\u0105d HTTP: !status","An AJAX HTTP request terminated abnormally.":"Zapytanie AJAX HTTP zosta\u0142o przerwane.","Debugging information follows.":"Informacje diagnostyczne.","Path: !uri":"\u015acie\u017cka: !uri","StatusText: !statusText":"StatusText: !statusText","ResponseText: !responseText":"ResponseText: !responseText","ReadyState: !readyState":"ReadyState: !readyState","Status":"Status","Disabled":"Wy\u0142\u0105czone","Enabled":"W\u0142\u0105czone","Size":"Wielko\u015b\u0107","Add":"Dodaj","Filename":"Nazwa pliku","Upload":"Wysy\u0142anie plik\u00f3w","Configure":"Konfiguruj","All":"Wszystko","N\/A":"niedost\u0119pne","Show":"Poka\u017c","Select all rows in this table":"Zaznacza wszystkie wiersze tabeli","Deselect all rows in this table":"Cofa zaznaczenie wszystkich wierszy tabeli","Not published":"Nie do publikacji","Please wait...":"Prosz\u0119 czeka\u0107...","Hide":"Ukryj","Loading":"\u0141adowanie","Only files with the following extensions are allowed: %files-allowed.":"Dozwolone s\u0105 jedynie pliki o nast\u0119puj\u0105cych rozszerzeniach: %files-allowed.","By @name on @date":"Przez @name w @date","By @name":"Przez @name","Not in menu":"Nie ma w menu","Alias: @alias":"Alias: @alias","No alias":"Brak aliasu","New revision":"Nowa wersja","Drag to re-order":"Chwy\u0107, by zmieni\u0107 kolejno\u015b\u0107","Changes made in this table will not be saved until the form is submitted.":"Zmiany wprowadzone w tabeli zachowuje si\u0119 przyciskiem u do\u0142u formularza.","The changes to these blocks will not be saved until the \u003Cem\u003ESave blocks\u003C\/em\u003E button is clicked.":"Zmiany wprowadzone w blokach zachowuje si\u0119 przyciskiem u do\u0142u formularza.","This permission is inherited from the authenticated user role.":"Te uprawnienia s\u0105 dziedziczone wed\u0142ug roli zalogowanego u\u017cytkownika.","No revision":"Brak wersji","@number comments per page":"@number komentarzy na stronie","Requires a title":"Tytu\u0142 wymagany","Not restricted":"Bez ogranicze\u0144","(active tab)":"(aktywna karta)","Not customizable":"Niekonfigurowalne","Restricted to certain pages":"Ograniczenie do okre\u015blonych stron.","The block cannot be placed in this region.":"Blok nie mo\u017ce by\u0107 umieszczony w tym obszarze.","Hide summary":"Ukryj podsumowanie","Edit summary":"Edycja podsumowania","Don\u0027t display post information":"Ukrycie informacji o wpisie","@title dialog":"@title dialog","The selected file %filename cannot be uploaded. Only files with the following extensions are allowed: %extensions.":"Wybrany plik %filename nie m\u00f3g\u0142 zosta\u0107 wys\u0142any. Dozwolone s\u0105 jedynie nast\u0119puj\u0105ce rozszerzenia: %extensions.","Re-order rows by numerical weight instead of dragging.":"Zmie\u0144 kolejno\u015b\u0107 wierszy podaj\u0105c warto\u015bci numeryczne zamiast przeci\u0105gaj\u0105c.","Show row weights":"Poka\u017c wagi wierszy","Hide row weights":"Ukryj wagi wierszy","Autocomplete popup":"Okienko autouzupe\u0142niania","Searching for matches...":"Wyszukiwanie pasuj\u0105cych...","Select all":"Zaznacz wszystko","Close":"Zamknij","Saving vote...":"Zapisywanie g\u0142osu...","Downloads":"Pobrania","From @title":"Od @title","Changes to the checkout panes will not be saved until the \u003Cem\u003ESave configuration\u003C\/em\u003E button is clicked.":"Zmiany nie b\u0119d\u0105 zapisane dop\u00f3ki przycisk \u003Cem\u003EZapisz ustawienia\u003C\/em\u003E nie zostanie klikni\u0119ty.","To @title":"Do @title","Owned by @name":"Nale\u017cy do @name","Created @date":"Utworzono @date","New order":"Nowe zam\u00f3wienie","Updated @date":"Zaktualizowano @date","Deselect all":"Odznacz wszystko"}} };;
(function ($) {

/**
 * Attaches double-click behavior to toggle full path of Krumo elements.
 */
Drupal.behaviors.devel = {
  attach: function (context, settings) {

    // Add hint to footnote
    $('.krumo-footnote .krumo-call').once().before('<img style="vertical-align: middle;" title="Click to expand. Double-click to show path." src="' + settings.basePath + 'misc/help.png"/>');

    var krumo_name = [];
    var krumo_type = [];

    function krumo_traverse(el) {
      krumo_name.push($(el).html());
      krumo_type.push($(el).siblings('em').html().match(/\w*/)[0]);

      if ($(el).closest('.krumo-nest').length > 0) {
        krumo_traverse($(el).closest('.krumo-nest').prev().find('.krumo-name'));
      }
    }

    $('.krumo-child > div:first-child', context).dblclick(
      function(e) {
        if ($(this).find('> .krumo-php-path').length > 0) {
          // Remove path if shown.
          $(this).find('> .krumo-php-path').remove();
        }
        else {
          // Get elements.
          krumo_traverse($(this).find('> a.krumo-name'));

          // Create path.
          var krumo_path_string = '';
          for (var i = krumo_name.length - 1; i >= 0; --i) {
            // Start element.
            if ((krumo_name.length - 1) == i)
              krumo_path_string += '$' + krumo_name[i];

            if (typeof krumo_name[(i-1)] !== 'undefined') {
              if (krumo_type[i] == 'Array') {
                krumo_path_string += "[";
                if (!/^\d*$/.test(krumo_name[(i-1)]))
                  krumo_path_string += "'";
                krumo_path_string += krumo_name[(i-1)];
                if (!/^\d*$/.test(krumo_name[(i-1)]))
                  krumo_path_string += "'";
                krumo_path_string += "]";
              }
              if (krumo_type[i] == 'Object')
                krumo_path_string += '->' + krumo_name[(i-1)];
            }
          }
          $(this).append('<div class="krumo-php-path" style="font-family: Courier, monospace; font-weight: bold;">' + krumo_path_string + '</div>');

          // Reset arrays.
          krumo_name = [];
          krumo_type = [];
        }
      }
    );
  }
};

})(jQuery);
;
