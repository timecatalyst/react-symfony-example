import React from 'react';
import {Button, CircularProgress, Fade, Grid, Theme, makeStyles} from '@material-ui/core';
import {Link as RouterLink} from 'react-router-dom';

type Props = {
  submitting: boolean;
  buttonText?: string;
  cancelTo?: string;
  cancelHref?: string;
  onCancel?: () => void;
};

const useStyles = makeStyles((theme: Theme) => ({
  buttonContainer: {
    marginTop: theme.spacing(2),
  },
  button: {
    marginLeft: theme.spacing(1),
  },
}));

const FormSubmitBar = ({submitting, cancelTo, cancelHref, onCancel, buttonText}: Props) => {
  const classes = useStyles();
  return (
    <Grid container justify="center" alignItems="center" className={classes.buttonContainer}>
      <Grid item>{submitting && <Progress />}</Grid>
      <CancelButton
        cancelTo={cancelTo}
        cancelHref={cancelHref}
        onCancel={onCancel}
        classes={classes}
      />
      <Grid item>
        <Button
          className={classes.button}
          type="submit"
          color="primary"
          variant="contained"
          disabled={submitting}
        >
          {buttonText || 'Submit'}
        </Button>
      </Grid>
    </Grid>
  );
};

const Progress = () => (
  <Fade in style={{transitionDelay: '800ms'}} unmountOnExit>
    <CircularProgress size={18} />
  </Fade>
);

type CancelButtonProps = {
  cancelTo?: string;
  cancelHref?: string;
  onCancel?: () => void;
  classes: {
    button: string;
  };
};

const CancelButton = ({cancelTo, cancelHref, onCancel, classes}: CancelButtonProps) => {
  if (onCancel) {
    return (
      <Grid item>
        <Button className={classes.button} variant="outlined" onClick={onCancel}>
          Cancel
        </Button>
      </Grid>
    );
  }
  if (cancelTo) {
    return (
      <Grid item>
        <Button className={classes.button} component={RouterLink} to={cancelTo}>
          Cancel
        </Button>
      </Grid>
    );
  }

  if (cancelHref) {
    return (
      <Grid item>
        <Button className={classes.button} href={cancelHref}>
          Cancel
        </Button>
      </Grid>
    );
  }

  return null;
};

export default FormSubmitBar;
