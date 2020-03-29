import React from 'react';
import ShimmerLine from 'components/UI/shimmer/ShimmerLine';
import { classes } from "style/shimmer";

const ShimmerTable = ({count}) => {
  
  const lines = () => {
    if (count === 0 ) {
      return [<ShimmerLine key='1' />];
    }
    if (count > 10) {
      count = 10;
    }
    var arr = [];
    var i = 0
    for(i=0; i<count; i++){
      arr.push(<ShimmerLine key={i} />);
    }
    return arr;
  }

  return (
    <>
      <div style={classes.container}>
        {lines()}
      </div>
    </>
  );
}

export default ShimmerTable;
