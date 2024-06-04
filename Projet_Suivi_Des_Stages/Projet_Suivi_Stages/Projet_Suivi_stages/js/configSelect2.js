$(document).ready(function() {
      $('#etudiant').select2({
      templateResult: formatResult,
  	  placeholder: "Sélectionnez un étudiant",
  	  minimumInputLength: 1,
      allowClear: true,
  	  language: {
      	noResults: function() {
      	return "Aucun résultat trouvé";
    },
    inputTooShort: function(args) {
        var remainingChars = args.minimum - args.input.length;
        return "Veuillez saisir au moins " + remainingChars + " caractère";
      }
  }
});


      $('#entreprise').select2({
        placeholder: "Sélectionnez une entreprise",
      	minimumInputLength: 1,
      	allowClear: true,
      	language: {
      		noResults: function() {
      			return "Aucun résultat trouvé";
    		},
    		inputTooShort: function(args) {
        		var remainingChars = args.minimum - args.input.length;
        		return "Veuillez saisir au moins " + remainingChars + " caractère";
      		}	
  		}
      });

      function formatResult(option) {
        if (!option.id) {
          return option.text;
        }

        var data = option.text.split(' ');
        var nom = data.slice(0, -1).join(' ');
        var prenom = data[data.length - 1];

        var result = $('<span>' + nom + ' <span style="color: gray;">(' + prenom + ')</span></span>');

        return result;
      }
    });
  