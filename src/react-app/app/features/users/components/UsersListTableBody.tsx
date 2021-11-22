import React from 'react';
import {IconButton, TableBody, TableCell, TableRow} from '@material-ui/core';
import DeleteIcon from '@material-ui/icons/Delete';
import {UsersListItem} from '../types';

interface Props {
  users: Array<UsersListItem>;
  onRowClick: (_: number) => () => void;
  onDelete: (_: UsersListItem) => () => void;
}

export default ({users, onRowClick, onDelete}: Props) => (
  <TableBody>
    {users.map((x) => (
      <TableRow key={x.id} hover>
        <TableCell onClick={onRowClick(x.id)}>{x.name}</TableCell>
        <TableCell onClick={onRowClick(x.id)}>{x.email}</TableCell>
        <TableCell>
          <IconButton onClick={onDelete(x)}>
            <DeleteIcon />
          </IconButton>
        </TableCell>
      </TableRow>
    ))}
  </TableBody>
);
