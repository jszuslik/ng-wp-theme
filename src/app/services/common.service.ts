import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment';
import {Observable} from 'rxjs/Observable';
import {FormGroup} from '@angular/forms';

@Injectable()
export class CommonService {
    private baseWpHost = environment.wpBase;
    private customWpHost = environment.wpCustomBase;

    constructor(protected http: HttpClient) { }

    getBlogDescription(): Observable<any> {
        return this.http.get<any>(this.customWpHost + 'bloginfo');
    }

    createNewSignUp(form: FormGroup): Observable<number> {
        return this.http.post<number>(this.customWpHost + 'form/signup', form.value);
    }
}