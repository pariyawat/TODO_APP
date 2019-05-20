import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';
import { AppService } from './app.service';

import {
  AuthService,
  FacebookLoginProvider,
  GoogleLoginProvider
} from 'angular-6-social-login';
import { MzModalService } from 'ngx-materialize';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {

  public editID = new FormControl('1');
  public editName = new FormControl('1');
  public editDetial = new FormControl('1');

  public name = new FormControl('');
  public detial = new FormControl('');

  public userData: any;
  public responseData: any;
  public haveSession: boolean;

  public taskData: any[];
  public status = { opened: 'opened', inprogress: 'inprogress', done: 'done' };
  constructor(private appService: AppService, private socialAuthService: AuthService, private modalService: MzModalService) {

  }

  // tslint:disable-next-line:use-life-cycle-interface
  ngOnInit() {
    this.checkLogin();

  }

  checkLogin() {
    this.userData = this.appService.getData();
    if (this.userData !== null) {
      this.haveSession = true;
      this.read();
    } else {
      this.haveSession = false;
    }

  }
  socialSignIn(socialPlatform: string) {
    let socialPlatformProvider: any;
    if (socialPlatform === 'facebook') {
      socialPlatformProvider = FacebookLoginProvider.PROVIDER_ID;
    }

    this.socialAuthService.signIn(socialPlatformProvider).then(userData => {
      this.appService.storData(userData);
      this.checkLogin();
    });
  }

  socialLogout() {
    this.appService.Logout();
    this.checkLogin();
  }

  async creat() {

    if (!this.name.value || !this.detial.value) {
      alert('Please insert Name and Detail');

    } else {
      const data = {
        user_id: this.userData.id,
        task_name: this.name.value,
        task_detial: this.detial.value
      };

      console.log();

      await this.appService.createTask(data).subscribe(response => {
        alert(response);
        this.read();
      }, (err) => {
        if (err.status === 200) {
          alert(err.status + 'Success');
          this.read();
        } else {
          alert(err.name);
        }

      });

      this.name = new FormControl('');
      this.detial = new FormControl('');
    }
  }

  read() {
    this.appService.getTask(this.userData.id).subscribe((res: any[]) => {
      this.taskData = res;
    });

  }

  moveToInprogress(id) {
    const data = {
      task_id: id,
      task_status: this.status.inprogress
    };
    this.appService.updateStatus(data).subscribe(res => {
      alert(res);
      this.read();
    }, (err) => {
      if (err.status === 200) {
        this.read();
      } else {
        alert(err.name);
      }

    });
  }

  moveToDone(id) {
    const data = {
      task_id: id,
      task_status: this.status.done
    };
    this.appService.updateStatus(data).subscribe(res => {
      alert(res);
      this.read();
    }, (err) => {
      if (err.status === 200) {
        this.read();
      } else {
        alert(err.name);
      }

    });
  }

  moveToOpened(id) {
    const data = {
      task_id: id,
      task_status: this.status.opened
    };
    this.appService.updateStatus(data).subscribe(res => {
      alert(res);
      this.read();
    }, (err) => {
      if (err.status === 200) {
        this.read();
      } else {
        alert(err.name);
      }

    });
  }

  delete(id) {

    this.appService.deleteTask(id).subscribe(res => {
      alert(res);
      this.read();
    }, (err) => {
      if (err.status === 200) {
        this.read();
      } else {
        alert(err.name);
      }

    });
  }

  edit(data) {

    this.editID.setValue(data.task_id);
    this.editName.setValue(data.task_name);
    this.editDetial.setValue(data.task_detial);
  }

  save() {
    const data = {
      task_id: this.editID.value,
      task_name: this.editName.value,
      task_detial: this.editDetial.value
    };

    this.appService.edit(data).subscribe(res => {
      alert(res);
      this.read();
    }, (err) => {
      if (err.status === 200) {
        this.read();
      } else {
        alert(err.name);
      }

    });

  }

}
