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

    const listStyle = {

        listStyleType: 'none'
        
    }

      return this.state.trails.map(trail => {
          return (
              /* When using list you need to specify a key
               * attribute that is unique for each list item
              */
              <li key={trail.id} style={listStyle}>
                  <p>Trail Name: { trail.name }
                  <br /> 
                  Trail Status: { trail.status }
                  </p>
              </li>      
          );
      })
    }
     
    render() {
        const mainDivStyle =  {
            display: "flex",
            flexDirection: "row"
        }
        
        const divStyle = {
           
            justifyContent: "flex-start",
            padding: '10px',
            width: '35%',
            background: '#f0f0f0',
            padding: '20px 20px 20px 20px',
            margin: '30px 10px 10px 30px',
            
        }

        return (
            <div>
              <div style= {mainDivStyle}>
                <div style={divStyle}>
                    <h3> All Trails </h3>
                      <ul>
                        { this.renderTrails() }
                      </ul> 
    
                </div> 
              </div>
                  
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