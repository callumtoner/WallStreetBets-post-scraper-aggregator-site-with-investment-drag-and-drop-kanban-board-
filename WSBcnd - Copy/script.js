const resultsNav = document.getElementById('resultsNav');
const favouritesNav = document.getElementById('favouritesNav');
const imagesContainer = document.querySelector('.images-container');
const saveConfirmed = document.querySelector('.save-confirmed');
const loader = document.querySelector('.loader');
const { body } = document; //for background changing, grab body to change background

// WSB API request, the offset gives 10 at a time, change offset dynamically below in method 
 let count = 0;
// let apiUrl = `http://ctoner28.lampt.eeecs.qub.ac.uk/WSBcnd/api.php?offset=${count}`;



let resultsArray = [];
let favourites = {};

// Scroll To Top, Remove Loader, Show Content
function showContent(page) {
  window.scrollTo({ top: 0, behavior: 'instant' });
  loader.classList.add('hidden');
  
  if (page === 'results') {
    resultsNav.classList.remove('hidden');
    favouritesNav.classList.add('hidden');
  } else {
    resultsNav.classList.add('hidden');
    favouritesNav.classList.remove('hidden');
  }
}

function createDOMNodes(page) {
  console.log('making cards ');
  // Load ResultsArray or Favourites depending on what's selected
  const currentArray = page === 'results' ? resultsArray : Object.values(favourites);
  currentArray.forEach((result) => {
    console.log(result); 
    
    // Card Container
    const card = document.createElement('div');
    card.classList.add('card');
    // Url 
    const link = document.createElement('a');
    link.href = result.url;
    link.title = 'View Full Image';
    link.target = '_blank';
    // Card Body
    const cardBody = document.createElement('div');
    cardBody.classList.add('card-body');
    // Card Title
    const cardTitle = document.createElement('h5');
    cardTitle.classList.add('card-title');
    cardTitle.textContent = result.title;
    // Save Text
    const saveText = document.createElement('p');
    saveText.classList.add('clickable');
    if (page === 'results') {
      saveText.textContent = 'Add To Favourites';
      saveText.setAttribute('onclick', `saveFavourite('${result.url}')`);
    } else {
      saveText.textContent = 'Remove Favourite';
      saveText.setAttribute('onclick', `removeFavourite('${result.url}')`);
    }
    // Card Text
    const cardText = document.createElement('p');
    cardText.textContent = result.body;
    // Footer Container
    const footer = document.createElement('small');
    footer.classList.add('text-muted');
    // Date
    const date = document.createElement('strong');
    date.textContent = result.timestamp;
    // Append
    footer.append(date);
    cardBody.append(cardTitle, saveText, cardText, footer);
    card.append(link, cardBody);
    imagesContainer.appendChild(card);
  });
}

function updateDOM(page) {
  // Get Favourites from localStorage
  if (localStorage.getItem('wsbFavourites')) {
    favourites = JSON.parse(localStorage.getItem('wsbFavourites'));
  }
  // Reset DOM, Create DOM Nodes, Show Content
  imagesContainer.textContent = '';
  createDOMNodes(page);
  showContent(page);
}

// Get 10 posts from my API
async function getwsbPosts() {
  console.log(count);
  // Show Loader
  loader.classList.remove('hidden');
  try {
    
    let apiUrl = `http://ctoner28.lampt.eeecs.qub.ac.uk/WSBcnd/api.php?offset=${count}`;
    const response = await fetch(apiUrl);
    console.log(apiUrl);
    resultsArray = await response.json(); 
    updateDOM('results');
  } catch (error) {
    console.log('something went wrong getting images from the API'); 
  }
  count += 10;
}

// Add result to Favourites
function saveFavourite(itemUrl) {
  // Loop through Results Array to select Favourite
  resultsArray.forEach((item) => {
    if (item.url.includes(itemUrl) && !favourites[itemUrl]) {
      favourites[itemUrl] = item;
      // Show Save Confirmation for 2 seconds
      saveConfirmed.hidden = false;
      setTimeout(() => {
        saveConfirmed.hidden = true;
      }, 2000);
      // Set Favourites in localStorage
      localStorage.setItem('wsbFavourites', JSON.stringify(favourites));
    }
  });
}

// Remove item from Favourites
function removeFavourite(itemUrl) {
  if (favourites[itemUrl]) {
    delete favourites[itemUrl];
    // Set Favourites in localStorage
    localStorage.setItem('wsbFavourites', JSON.stringify(favourites));
    updateDOM('favourites');
  }
}

//background changer ----------------------------
function changeBackground(number) {
  //check if background already on
  let previousBackground;
  if (body.className) {
      previousBackground = body.className; 
      //if no class applied already then we set the old background to this 1
  }
  //reset css classes for body applied
  body.className = ''; 
  
  switch (number) {
      case '1': 
        return (previousBackground === 'background-1' ? false : body.classList.add('background-1'));
      case '2': 
        return (previousBackground === 'background-2' ? false : body.classList.add('background-2'));
      case '3': 
      return (previousBackground === 'background-3' ? false : body.classList.add('background-3'));  
      default: 
          break;
  }
}
//------------------------------------------------

// On Load run this function to populate the first 10 posts automatically 
getwsbPosts();



//references for dynamic JS module: 
//https://blog.logrocket.com/how-to-dynamically-create-javascript-elements-with-event-handlers/ 
//https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage 
//https://getloaf.io/
//https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Editable_content
//https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Editable_content
//https://stackoverflow.com/questions/5536596/dynamically-creating-html-elements-using-javascript 
//https://stackoverflow.com/questions/61811128/creating-a-const-with-js-for-background-url-to-change-background 
//https://www.w3schools.com/jsref/met_document_createelement.asp