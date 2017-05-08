/**
 * Created by kento on 5/7/17.
 */

import React from 'react';

const EmployeeGrid = ({employees}) => (
    <table className="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Salary</th>
            <th><i>Edit</i></th>
        </tr>
        </thead>
        <tbody>
        {employees.map((employee) => (
            <tr>
        <td>{employee.name}</td>
        <td>{employee.email}</td>
        <td>{employee.position}</td>
        <td>{employee.salary}</td>
                <td>
                    <p class="field">
                    <a className="button is-success">
    <span className="icon is-small">
      <i className="fa fa-edit"></i>
    </span>
                    </a>
                    </p>
                </td>
            </tr>
            )
        )}
        </tbody>
    </table>
);

export default EmployeeGrid;
