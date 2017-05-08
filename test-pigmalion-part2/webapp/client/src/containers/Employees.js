/**
 * Created by kento on 5/7/17.
 */

import React from 'react';
import EmployeeGrid from '../components/EmployeeGrid';
import Search from '../components/Search';

class Employees extends React.Component {
    constructor(props) {
        super(props);
        this.state = { employees: [] }
    }

    componentWillMount() {
        $.getJSON("/api/v1/employees", (response) => {
            this.setState({ employees: response });
        });
    }

    render() {
        return(
            <div>
                <Search/>
            <EmployeeGrid employees={this.state.employees} />
            </div>
        );
    }
}

export default Employees;
