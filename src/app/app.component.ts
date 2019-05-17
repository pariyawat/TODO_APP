import { Component } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {

  todoInput = new FormControl('');
  todoArr = [];
  doneArr = [];
  addTodo(value: string) {
    this.todoArr.push(value);
  }

  done(index, value) {
    this.doneArr.push(value);
    this.todoArr.splice(index, index);

  }

  
  delete(index) {
    this.todoArr.splice(index, index);
  }


}
