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

    private _getMainMenuUrl = this.customWpHost + 'mainmenu';

    getMainMenu(): Observable<MenuItem[]> {
        console.log(this._http.get<MenuItem[]>(this._getMainMenuUrl));
        return this._http.get<MenuItem[]>(this._getMainMenuUrl);
    }

}