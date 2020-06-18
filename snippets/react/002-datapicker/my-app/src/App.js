import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import DateTimePicker from 'react-datetime-picker';

class MyForm extends Component {
  state = {
    date: new Date(),
  }
 
  onChange = date => this.setState({ date })
 
  render() {
    return (
      <div>
        <DateTimePicker
          onChange={this.onChange}
          value={this.state.date}
        />
      </div>
    );
  }
}

function App() {
  return (
    <div className="App">
      <MyForm/>
    </div>
  );
}

export default App;
