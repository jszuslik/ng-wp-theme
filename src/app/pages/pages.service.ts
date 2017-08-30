import {Injectable} from '@angular/core';
import {environment} from '../../environments/environment';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs/Observable';
import {Page} from './page';

@Injectable()
export class PagesService {
    private baseWpHost = environment.wpBase;
    private customWpHost = environment.wpCustomBase;

    constructor(protected http: HttpClient) {}

    getPages(): Observable<Page[]> {
        return this.http.get<Page[]>(this.baseWpHost + 'pages');
    }

    getPage(slug: string): Observable<Page> {
        // console.log(this.customWpHost + `pages/${slug}`);
        // console.log(this.http.get<Page[]>(this.customWpHost + `pages/${slug}`));
        return this.http.get<Page>(this.customWpHost + `pages/${slug}`);
    }
}