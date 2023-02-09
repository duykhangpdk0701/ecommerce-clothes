import React from "react";
import {
  Container,
  Typography,
  Stack,
  Button,
  Grid,
  Paper,
  TextField,
  Box,
  FormControlLabel,
  Switch,
} from "@mui/material";
import Iconify from "@/components/shared/iconify";
import Link from "next/link";
import dynamic from "next/dynamic";
const ReactQuill = dynamic(() => import("react-quill"), { ssr: false });

const CreateBrandTemplate = () => {
  return (
    <main>
      <Container>
        <Stack
          direction="row"
          alignItems="center"
          justifyContent="space-between"
          mb={5}
        >
          <Typography variant="h4" gutterBottom>
            Brand
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/brand"
          >
            Back to List Brand
          </Button>
        </Stack>
        <form>
          <Grid container spacing={3}>
            <Grid item xs={12} md={8}>
              <Paper className="p-6">
                <TextField label="Name" fullWidth />
                <Box className="mt-6">
                  <Typography variant="h6">Description</Typography>
                  <ReactQuill placeholder="Write something about Brand" />
                </Box>
              </Paper>
            </Grid>
            <Grid item xs={12} md={4}>
              <Paper className="p-6">
                <FormControlLabel
                  control={<Switch defaultChecked />}
                  label="Status"
                />
                <Box className="mt-6">
                  <TextField label="Slug" fullWidth />
                </Box>
                <Box className="mt-6">
                  <TextField label="Order" fullWidth />
                </Box>
              </Paper>
              <Button
                className="mt-6"
                fullWidth
                variant="contained"
                size="large"
              >
                Submit
              </Button>
            </Grid>
          </Grid>
        </form>
      </Container>
    </main>
  );
};

export default CreateBrandTemplate;
