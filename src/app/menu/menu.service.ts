import {environment} from '../../environments/environment';
import {Injectable} from '@angular/core';
import {Observable} from 'rxjs/Observable';
import {MenuItem} from '../classes/menuitem';
import {HttpClient} from '@angular/common/http';

@Injectable()
export class MenuService {
    baseWpHost = environment.wpBase;
    customWpHost = environment.wpCustomBase;
    constructor (private _http: HttpClient) {

    }

    private _getMenusUrl = this.customWpHost + 'menus/';

    getMenu(menu: string): Observable<MenuItem[]> {
        console.log(this._http.get<MenuItem[]>(this._getMenusUrl + menu));
        return this._http.get<MenuItem[]>(this._getMenusUrl + menu);
    }

}