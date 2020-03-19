import React from 'react';
import ReactDOM from 'react-dom';

function Example() {
    return (
        <div>I'm an example component!</div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
