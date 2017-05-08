/**
 * Created by kento on 5/7/17.
 */

import React from 'react';

const Search = () => (
    <div className="field is-grouped">
        <p className="control is-expanded">
            <input className="input" type="text" placeholder="Buscar por correo electronico" />
        </p>
        <p className="control">
            <a className="button is-info">
                Search
            </a>
        </p>
    </div>
);

export default Search;


