import React, { Component } from "react";
import FileViewer from "react-file-viewer";
import axios from "axios";
export class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      type: "",
      file: "",
      error: false
    };
  }
  componentDidMount() {
    this.getDocs();
    document.addEventListener("click", this.handleClick);
    document.addEventListener("contextmenu", this.handleContextMenu);
  }
  componentWillUnmount() {
    document.removeEventListener("click", this.handleClick);
    document.removeEventListener("contextmenu", this.handleContextMenu);
}
handleClick = (e) => {
}

handleContextMenu = (e) => {
  e.preventDefault();
}

    getDocs = async () => {
      const pathArray = window.location.pathname.split("/");
      const getFid = pathArray[2];
      const baseUrl = window.location.origin;
      let url = baseUrl + "/react-doc-viewver/" + getFid+"?_format=json";
      try {
        const rest = await axios.get(
          url
        );
        this.setState({
          type: rest.data.type,
          file: rest.data.url
        });

      } catch (error) {
        this.setState({
          error: true
        });
      }
    };
  render() {
    return (
      <div className="App">
        <a className="btn btn-primary" href={this.state.file} >
          download
        </a>
        <FileViewer fileType={this.state.type} filePath={this.state.file} />
        </div>
    )
    
  }
}

export default App;
