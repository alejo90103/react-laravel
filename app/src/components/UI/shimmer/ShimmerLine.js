import React from 'react';
import Shimmer from "react-shimmer-effect";

import { classes } from "style/shimmer";

const ShimmerLine = () => {
  return (
    <div className='row d-flex p-3'>
      <Shimmer>
        <div className='col-md-10 ml-2' style={classes.line} />
      </Shimmer>
      <Shimmer>
        <div style={classes.circle} />
      </Shimmer>
      <Shimmer>
        <div style={classes.circle} />
      </Shimmer>
    </div>
  );
}

export default ShimmerLine;
