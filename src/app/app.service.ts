import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AppService {

  constructor(private http: HttpClient) { }
  public url = 'http://192.168.1.36/TODO-APP/server/api/task/';
  // public url = 'https://test-1p.000webhostapp.com/server/api/task/';
  async storData(data) {
    localStorage.setItem('userData', JSON.stringify(data));
  }

  getData() {
    return JSON.parse(localStorage.getItem('userData'));
  }

  Logout() {
    localStorage.setItem('userData', '');
    localStorage.clear();
  }

  createTask(data) {
    return this.http.post(this.url + 'create.php', JSON.stringify(data));
  }

  getTask(id) {
    return this.http.get(this.url + 'read.php?id=' + id);
  }

  updateStatus(data) {
    return this.http.put(this.url + 'update_status.php', JSON.stringify(data));
  }

  deleteTask(id) {
    return this.http.delete(this.url + 'delete.php?id=' + id);
  }

  edit(data) {
    return this.http.put(this.url + 'update.php', JSON.stringify(data));
  }
}
