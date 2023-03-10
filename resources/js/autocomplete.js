const fullAddressInput = document.getElementById('full_address');
const addressBox = document.getElementById('address-box');

var searchOptions = {
    key: 'rFBdfrmDGxYGTYFyFgUSJwBNs9rGpctr',
    language: 'it-IT',
    limit: 5
};

var autocompleteOptions = {
    key: 'rFBdfrmDGxYGTYFyFgUSJwBNs9rGpctr',
    language: 'it-IT'
};

var searchBoxOptions = {
    minNumberOfCharacters: 0,
    searchOptions: searchOptions,
    autocompleteOptions: autocompleteOptions
};

var searchBox = new tt.plugins.SearchBox(tt.services, searchBoxOptions);

if (fullAddressInput.value) searchBox.setValue(fullAddressInput.value);

var inputElement = searchBox.getSearchBoxHTML().querySelector('input');
inputElement.addEventListener('input', function () {
    fullAddressInput.value = inputElement.value;
});

searchBox.on('tomtom.searchbox.resultselected', function (data) {
    fullAddressInput.value = data.data.text;
});

var searchBoxHTML = searchBox.getSearchBoxHTML();

var closeIcon = searchBoxHTML.querySelector('.tt-search-box-close-icon');
closeIcon.addEventListener('click', function () {
    fullAddressInput.value = '';
});

addressBox.append(searchBoxHTML);
