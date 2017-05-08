/**
 * Created by kento on 5/7/17.
 */
import React from 'react';
import {render} from 'react-dom';
import EmployeesContainer from './containers/Employees';

class App extends React.Component {
    render () {
        return (
            <EmployeesContainer {...this.props} />
        );
    }
}

render(<App/>, document.getElementById('app'));