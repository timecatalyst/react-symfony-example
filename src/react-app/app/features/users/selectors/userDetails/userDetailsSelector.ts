import {createSelector} from 'reselect';
import userDetailsSliceSelector from './userDetailsSliceSelector';

export default createSelector(userDetailsSliceSelector, (slice) => slice.userDetails);
