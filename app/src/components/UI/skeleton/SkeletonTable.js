import React from 'react';
import SkeletonLine from 'components/UI/skeleton/SkeletonLine';
// import { classes } from "style/shimmer";

const SkeletonTable = ({count}) => {
  
  const lines = () => {
    if (count === 0 ) {
      return [<SkeletonLine key='1' />];
    }
    if (count > 10) {
      count = 10;
    }
    var arr = [];
    var i = 0
    for(i=0; i<count; i++){
      arr.push(<SkeletonLine key={i} />);
    }
    return arr;
  }

  return (
    <>
      <div >
        {lines()}
      </div>
    </>
  );
}

export default SkeletonTable;
