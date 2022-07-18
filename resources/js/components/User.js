import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import Select from 'react-select'; 
import makeAnimated from 'react-select/animated';



function User() {
    const animatedComponents = makeAnimated();
    const test = [
        { value: "chocolate", label: "Chocolate" },
        { value: "strawberry", label: "Strawberry"},
        { value: "vanilla", label: "Vanilla"},
      ];
    
    var [Displayvalue, getvalue]=useState('');  
    
    var Ddlhandle = (e) => 
    {
        getvalue(Array.isArray(e)?e.map(x=>x.label):[]);
    }  



    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card text-center">
                        <div className="card-header"><h2>React Component in Laravel</h2></div>
                        <div className="card-body">Raka Arif Budiman</div>                        
                    </div>
                    <div className="card text-center">
                        <Select isMulti                         
                        options={test} 
                        onChange={Ddlhandle}
                        > 
                                              
                        </Select>
                        
                        <h3> Value = {Displayvalue + " "}</h3>

                    </div>
                </div>
            </div>
        </div>
    );
}
export default User;


// DOM element
if (document.getElementById('user')) {
    ReactDOM.render(<User />, document.getElementById('user'));
}