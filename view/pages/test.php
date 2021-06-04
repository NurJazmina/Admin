<link href="assets/css/todo.css" rel="stylesheet" >
<body>
  <h3>Gordon's To-do List</h3>
  <div class="todo-grid-parent">

    <div>
      <div class="todo-input todo-block">
        <span>To-do: </span>
        <input type="text" placeholder="Enter new to-do">
        <span>Category: </span>
        <input type="text" placeholder="Enter category" list="categoryList">
        <datalist id="categoryList">
          <option value="Personal"></option>
          <option value="Work"></option>
        </datalist>
        <span>Date:</span>
        <input type="date" id="dateInput">
        <span>Time:</span>
        <input type="time" id="timeInput">
        <span></span>
        <button id="addBtn">Add</button>
        <span></span>
        <button id="sortBtn">Sort by Date</button>
        <span></span>
        <label><input type="checkbox" id="shortlistBtn"> Incomplete First </label>
        
      </div>

      <table id="todoTable" class=" todo-block">
        <tr>
          <td></td>
          <td>Date</td>
          <td>Time</td>
          <td>to-do</td>
          <td>
            <select id="categoryFilter">
            </select>
          </td>
          <td></td>
        </tr>
      </table>
    </div>

    <div class="todo-calendar  todo-block">
      <div id='calendar'></div>
    </div>

  </div> <!-- class="todo-grid-parent" -->

  <div class="todo-overlay" id="todo-overlay">
    <div class="todo-modal" id="todo-modal">
      <div class="todo-input todo-block">
        <span>To-do: </span>
        <input type="text" placeholder="Enter new to-do" id="todo-edit-todo">
        <span>Category: </span>
        <input type="text" placeholder="Enter category" list="categoryList"  id="todo-edit-category">
        <datalist id="categoryList">
          <option value="Personal"></option>
          <option value="Work"></option>
        </datalist>
        <span>Date:</span>
        <input type="date" id="todo-edit-date">
        <span>Time:</span>
        <input type="time" id="todo-edit-time">
        <span></span>
        <button id="changeBtn">Save Change</button>
      </div>
    </div>
    <div class="todo-modal-close-btn" id="todo-modal-close-btn">X</div>
  </div>
  
</body>