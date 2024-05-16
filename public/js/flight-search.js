
function dynamicDropDown(listIndex) {

    document.getElementById("infants").length = 0;
    document.getElementById("children").length = 0;
  
    for (let i = 0; i < Number(listIndex) + 1; i++) {
      document.getElementById("infants").options[i] = new Option(i.toString(), i);
    }
  
    for (let i = 0; i < 9 - Number(listIndex) + 1; i++) {
      document.getElementById("children").options[i] = new Option(i.toString(), i);
    }
  }
  function handleKeydown(event, autocompleteId) {
    var autocompleteContainer = document.getElementById(autocompleteId);
    var items = autocompleteContainer.getElementsByTagName('div');
    var focusedItemIndex = -1;

    for (var i = 0; i < items.length; i++) {
        if (items[i] === event.target) {
            focusedItemIndex = i;
            break;
        }
    }

    switch (event.key) {
        case 'ArrowUp':
            if (focusedItemIndex > 0) {
                items[focusedItemIndex - 1].focus();
            }
            break;
        case 'ArrowDown':
            if (focusedItemIndex < items.length - 1) {
                items[focusedItemIndex + 1].focus();
            }
            break;
        case 'Enter':
            event.preventDefault();
            event.target.click();
            break;
        default:
            break;
    }
}   
