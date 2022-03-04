<?php
session_start(); 
if(!isset($_SESSION['userloggedin'])) {
    header("location:http://ctoner28.lampt.eeecs.qub.ac.uk/Accounts/index.php"); 
}


?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WSB Kanban Board</title>
    <link rel="icon" type="image/png" href="WSB.png">
    <link rel="stylesheet" href="styleKanban.css">
</head>
<body>
    <h1 class="main-title"> WallStreetBets Kanban Board</h1>
    <div class="drag-container">
        <ul class="drag-list">
            <!-- Buy Column -->
            <li class="drag-column buy-column">
                <span class="header">
                    <h1>Buy</h1>
                </span>
                <!-- buy Content -->
                <div id="buy-content" class="custom-scroll">
                    <ul class="drag-item-list" id="buy-list" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(0)"></ul>
                </div>
                <!-- Add Button Group -->
                <div class="add-btn-group">
                    <div class="add-btn" onclick="showInputBox(0)">
                        <span class="plus-sign">+</span>
                        <span>Add Item</span>
                    </div>
                    <div class="add-btn solid" onclick="hideInputBox(0)">
                        <span>Save Item</span>
                    </div>
                </div>
                <div class="add-container">
                    <div class="add-item" contenteditable="true"></div>
                </div>
            </li>
            <!-- Sell Column -->
            <li class="drag-column sell-column">
                <span class="header">
                    <h1>Sell</h1>
                </span>
                <!-- sell Content -->
                <div id="sell-content" class="custom-scroll">
                    <ul class="drag-item-list" id="sell-list" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(1)"></ul>
                </div>
                <!-- Add Button Group -->
                <div class="add-btn-group">
                    <div class="add-btn" onclick="showInputBox(1)">
                        <span class="plus-sign">+</span>
                        <span>Add Item</span>
                    </div>
                    <div class="add-btn solid" onclick="hideInputBox(1)">
                        <span>Save Item</span>
                    </div>
                </div>
                <div class="add-container">
                    <div class="add-item" contenteditable="true"></div>
                </div>
            </li>
            <!-- hold Column -->
            <li class="drag-column hold-column">
                <span class="header">
                    <h1>Hold</h1>
                </span>
                <!-- hold Content -->
                <div id="hold-content" class="custom-scroll">
                    <ul class="drag-item-list" id="hold-list" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(2)"></ul>
                </div>
                <!-- Add Button Group -->
                <div class="add-btn-group">
                    <div class="add-btn" onclick="showInputBox(2)">
                        <span class="plus-sign">+</span>
                        <span>Add Item</span>
                    </div>
                    <div class="add-btn solid" onclick="hideInputBox(2)">
                        <span>Save Item</span>
                    </div>
                </div>
                <div class="add-container">
                    <div class="add-item" contenteditable="true"></div>
                </div>
            </li>
            <!-- notes Column -->
            <li class="drag-column notes-column">
                <span class="header">
                    <h1>Notes</h1>
                </span>
                <!-- notes Content -->
                <div id="notes-content" class="custom-scroll">
                    <ul class="drag-item-list" id="notes-list" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(3)"></ul>
                </div>
                <!-- Add Button Group -->
                <div class="add-btn-group">
                    <div class="add-btn" onclick="showInputBox(3)">
                        <span class="plus-sign">+</span>
                        <span>Add Item</span>
                    </div>
                    <div class="add-btn solid" onclick="hideInputBox(3)">
                        <span>Save Item</span>
                    </div>
                </div>
                <div class="add-container">
                    <div class="add-item" contenteditable="true"></div>
                </div>
            </li>
        </ul>
    </div>
    <!-- Script -->
    <script src="scriptKanban.js"></script>
</body>
</html>