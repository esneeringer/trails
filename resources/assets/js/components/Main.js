import React, { Component } from 'react';
import ReactDOM from 'react-dom';
 
/* Main Component */
class Main extends Component {
 
    constructor() {
     
      super();
      //Initialize the state in the constructor
      this.state = {
          trails: [],
      }
    }
    /*componentDidMount() is a lifecycle method
     * that gets called after the component is rendered
     */
    componentDidMount() {
      /* fetch API in action */
      fetch('/api/trails')
          .then(response => {
              return response.json();
          })
          .then(trails => {
              //Fetched trail is stored in the state
              this.setState({ trails });
          });
    }
   
   renderTrails() {
      return this.state.trails.map(trail => {
          return (
              /* When using list you need to specify a key
               * attribute that is unique for each list item
              */
              <li key={trail.id} >
                  { trail.name } 
              </li>      
          );
      })
    }
     
    render() {
     /* Some css code has been removed for brevity */
      return (
          <div>
                <ul>
                  { this.renderTrails() }
                </ul> 
              </div> 
         
      );
    }
  }
 
export default Main;
 
/* The if statement is required so as to Render the component on pages that have a div with an ID of "root";  
*/
 
if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}