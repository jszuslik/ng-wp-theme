import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {Observable} from 'rxjs/Observable';
import {FormGroup} from '@angular/forms';
import {FormResponse} from '../classes/form-response';

@Injectable()
export class CommonService {
    private baseWpHost = environment.wpBase;
    private customWpHost = environment.wpCustomBase;

    constructor(protected http: HttpClient) { }

    getBlogDescription(): Observable<any> {
        return this.http.get<any>(this.customWpHost + 'bloginfo');
    }

    createNewSignUp(form: FormGroup): Observable<FormResponse> {
        return this.http.post<FormResponse>(this.customWpHost + 'form/signup', form.value);
    }
    createNewFeedback(form: FormGroup): Observable<FormResponse> {
        return this.http.post<FormResponse>(this.customWpHost + 'form/feedback', form.value);
    }
}