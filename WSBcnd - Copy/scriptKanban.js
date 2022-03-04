const addBtns = document.querySelectorAll('.add-btn:not(.solid)');
const saveItemBtns = document.querySelectorAll('.solid');
const addItemContainers = document.querySelectorAll('.add-container');
const addItems = document.querySelectorAll('.add-item');
// element Lists
const listColumns = document.querySelectorAll('.drag-item-list');
const buyListEl = document.getElementById('buy-list'); 
const sellListEl = document.getElementById('sell-list'); 
const holdListEl = document.getElementById('hold-list');
const notesListEl = document.getElementById('notes-list');

// Items
let updatedOnLoad = false;

// Initialise empty arrays
let buyArray = [];
let sellArray = [];
let holdArray = [];
let notesArray = [];
let listArrays = [];

// Drag Functionality
let draggedItem;
let dragging = false;
let currentColumn;

// gets values from local storage - sets default values if empty
function getSavedColumns() {
  if (localStorage.getItem('buyItems')) {
    buyArray = JSON.parse(localStorage.buyItems);
    sellArray = JSON.parse(localStorage.sellItems);
    holdArray = JSON.parse(localStorage.holdItems);
    notesArray = JSON.parse(localStorage.notesItems);
  } else {
    buyArray = ['TSLA', 'SHOP'];
    sellArray = ['BB', 'GME'];
    holdArray = ['CRSP', 'PLTR'];
    notesArray = ['Find more DD posts for strike prices'];
  }
}

// Set localStorage Arrays
function updateSavedColumns() {
  listArrays = [buyArray, sellArray, holdArray, notesArray];
  const arrayNames = ['buy', 'sell', 'hold', 'notes'];
  arrayNames.forEach((arrayName, index) => {
    localStorage.setItem(`${arrayName}Items`, JSON.stringify(listArrays[index]));
  });
}

// removes empty array values
function filterArray(array) {
  const filteredArray = array.filter(item => item !== null);
  return filteredArray;
}

// Create each kanban input with the html and css 
function createItemEl(columnEl, column, item, index) {
  // List Item
  const listEl = document.createElement('li');
  listEl.textContent = item;
  listEl.id = index;
  listEl.classList.add('drag-item');
  listEl.draggable = true;
  listEl.setAttribute('onfocusout', `updateItem(${index}, ${column})`);
  listEl.setAttribute('ondragstart', 'drag(event)');
  listEl.contentEditable = true;
  // Append
  columnEl.appendChild(listEl);
}

// Update Columns of the board - Resets the html, filters array, edits the local storage 
function updateDOM() {
  // Check localStorage once
  if (!updatedOnLoad) {
    getSavedColumns();
  }
  // Backlog Column
  buyListEl.textContent = '';
  buyArray.forEach((buyItem, index) => {
    createItemEl(buyListEl, 0, buyItem, index);
  });
  buyArray = filterArray(buyArray);
  // Progress Column
  sellListEl.textContent = '';
  sellArray.forEach((sellItem, index) => {
    createItemEl(sellListEl, 1, sellItem, index);
  });
  sellArray = filterArray(sellArray);
  // Complete Column
  holdListEl.textContent = '';
  holdArray.forEach((holdItem, index) => {
    createItemEl(holdListEl, 2, holdItem, index);
  });
  holdArray = filterArray(holdArray);
  // On Hold Column
  notesListEl.textContent = '';
  notesArray.forEach((notesItem, index) => {
    createItemEl(notesListEl, 3, notesItem, index);
  });
  notesArray = filterArray(notesArray);
  
  updatedOnLoad = true;
  updateSavedColumns();
}

// Update Item 
function updateItem(id, column) {
  const selectedArray = listArrays[column];
  const selectedColumn = listColumns[column].children;
  if (!dragging) {
    if (!selectedColumn[id].textContent) {
      delete selectedArray[id];
    } else {
      selectedArray[id] = selectedColumn[id].textContent;
    }
    updateDOM();
  }
}

// Add to Column List, Reset Textbox
function addToColumn(column) {
  const itemText = addItems[column].textContent;
  const selectedArray = listArrays[column];
  selectedArray.push(itemText);
  addItems[column].textContent = '';
  updateDOM(column);
}

// Show Add Item Input Box
function showInputBox(column) {
  addBtns[column].style.visibility = 'hidden';
  saveItemBtns[column].style.display = 'flex';
  addItemContainers[column].style.display = 'flex';
}

// Hide Item Input Box
function hideInputBox(column) {
  addBtns[column].style.visibility = 'visible';
  saveItemBtns[column].style.display = 'none';
  addItemContainers[column].style.display = 'none';
  addToColumn(column);
}

// Allows arrays to reflect Drag and Drop items
function rebuildArrays() {
  buyArray = [];
  for (let i = 0; i < buyListEl.children.length; i++) {
    buyArray.push(buyListEl.children[i].textContent);
  }
  sellArray = [];
  for (let i = 0; i < sellListEl.children.length; i++) {
    sellArray.push(sellListEl.children[i].textContent);
  }
  holdArray = [];
  for (let i = 0; i < holdListEl.children.length; i++) {
    holdArray.push(holdListEl.children[i].textContent);
  }
  notesArray = [];
  for (let i = 0; i < notesListEl.children.length; i++) {
    notesArray.push(notesListEl.children[i].textContent);
  }
  updateDOM();
}

//Dragging into new column
function dragEnter(column) {
  listColumns[column].classList.add('over');
  currentColumn = column;
}

// when you start dragging item
function drag(e) {
  draggedItem = e.target;
  dragging = true;
}

// responsive column as recepticle for the item drop
function allowDrop(e) {
  e.preventDefault();
}

// dropping/releaseing item to the new column
function drop(e) {
  e.preventDefault();
  const parent = listColumns[currentColumn];
  // Remove Background Color/Padding
  listColumns.forEach((column) => {
    column.classList.remove('over');
  });
  // Add item to Column
  parent.appendChild(draggedItem);
  // Dragging complete
  dragging = false;
  rebuildArrays();
}

// On Load
updateDOM();


//references for the kanban board module: 
// https://www.w3schools.com/html/html5_draganddrop.asp
// https://www.w3schools.com/tags/att_ondragenter.asp
// https://css-tricks.com/the-current-state-of-styling-scrollbars/
// https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Editable_content
// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/push
// https://developer.mozilla.org/en-US/docs/Web/API/Element/focusout_event
// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter
//https://www.atlassian.com/agile/kanban/boards 
//https://www.youtube.com/watch?v=tZ45HZAkbLc