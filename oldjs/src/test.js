import React from "react";
import { useEffect, useState } from "react";
import DocViewer from "react-doc-viewer";
import axios from "axios";
const App = () => {
  const getHeaders = {
    'content-type': 'application/json'
  }

  const [docs, setDocs] = useState([]);
  useEffect(() => {
    getDocs();
  }, []);


  const getDocs = async () => {
   log.table("test");
    //axios.post
    // const rest = await axios.post("/rdv?_format=json", {"fid" : 654}, { headers: getHeaders });
    // console.table(rest.data);
    // setDocs(rest.data);
  }
  return (
    <>
      {/* <DocViewer documents={docs} /> */}
      <div>
        <h1>Hello World</h1>
        <p>This is a paragraph</p>
      </div>
    </>
  );
};
export default App;
