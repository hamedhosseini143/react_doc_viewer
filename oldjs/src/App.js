import React from "react";
import { useEffect, useState } from "react";
import DocViewer, { DocViewerRenderers } from "react-doc-viewer";
import axios from "axios";

function App() {
  const pathArray = window.location.pathname.split("/");
  const fid = pathArray[2];
  const baseUrl = window.location.origin;

  const [uri, setUri] = useState([]);
  const [permission, setPermission] = useState([]);
  const [status, setStatus] = useState([true]);

  useEffect(() => {
    getDocs();
  }, []);

  const getDocs = async () => {
    try {
      const rest = await axios.get(
        `${baseUrl}/react-doc-viewver/${fid}?_format=json`
      );
      setUri(rest.data.url);
    } catch (error) {
      setStatus(false);
    }
  };
  const docs = [
    {
       uri: uri
    }
  ];



  

  return (
    <div className="App">
      {status ? (
        <div>
          <div className="download">
            <a href={uri}>Download</a>
          </div>
          <DocViewer
            pluginRenderers={DocViewerRenderers}
            documents={docs}
            theme={{
              primary: "#5296d8",
              secondary: "#ffffff",
              tertiary: "#5296d899",
              text_primary: "#ffffff",
              text_secondary: "#5296d8",
              text_tertiary: "#00000099",
              disableThemeScrollbar: false
            }}
            config={{
              header: {
                disableHeader: false,
                disableFileName: false,
                retainURLParams: false
              }
            }}
            
          />
        </div>
      ) : (
        <div>
          <h1>404</h1>
        </div>
      )}
    </div>
  );
}

export default App;
