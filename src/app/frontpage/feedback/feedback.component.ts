import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup} from '@angular/forms';
import {CommonService} from '../../services/common.service';
import {FormResponse} from '../../classes/form-response';

@Component({
  selector: 'app-feedback',
  templateUrl: './feedback.component.html',
  styleUrls: ['./feedback.component.scss']
})
export class FeedbackComponent implements OnInit {

    feedbackForm = new FormGroup({
        'name': new FormControl(),
        'email': new FormControl(),
        'phone': new FormControl(),
        'message': new FormControl()
    });
    response: FormResponse;
    fbIsFormSuccess = false;
    fbFormSuccessMessage = 'Thank you for submitting your feedback';
    fbIsFormError = false;
    fbFormErrorMessage = 'There was an error submitting your form';

    constructor(private _cs: CommonService) { }

    onSubmit() {
        this._cs.createNewFeedback(this.feedbackForm)
            .subscribe(
                (response: FormResponse) => {
                    if(response.id) {
                        this.fbIsFormSuccess = true;
                        this.fbIsFormError = false;
                        this.response = response;
                        this.feedbackForm.reset();
                    } else {
                        this.fbIsFormSuccess = false;
                        this.fbIsFormError = true;
                        this.response = response;
                    }
                    console.log(response);
                },
                (error: any) => {
                    console.log(error);
                    this.fbFormErrorMessage = error.message;
                },
                () => {
                    this.fbFormSuccessMessage = 'Thank You ' + this.response.message + '! We will contact you shortly';
                    this.fbFormErrorMessage = this.response.message;
                }
            );
    }

    ngOnInit() {
    }

}
