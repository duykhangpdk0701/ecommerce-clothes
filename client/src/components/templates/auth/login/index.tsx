import VisibilityOffIcon from "@mui/icons-material/VisibilityOff";
import VisibilityIcon from "@mui/icons-material/Visibility";
//mui component
import LoadingButton from "@mui/lab/LoadingButton";
import Box from "@mui/material/Box";
import Button from "@mui/material/Button";
import InputLabel from "@mui/material/InputLabel";
import Paper from "@mui/material/Paper";
import OutlinedInput from "@mui/material/OutlinedInput";
import FormHelperText from "@mui/material/FormHelperText";
import Divider from "@mui/material/Divider";
import IconButton from "@mui/material/IconButton";
import AlertTitle from "@mui/material/AlertTitle";
import Alert from "@mui/material/Alert";
import InputAdornment from "@mui/material/InputAdornment";
//nextjs
import Image from "next/image";
import Link from "next/link";
import React, { FC, useState } from "react";
import {
  Control,
  Controller,
  FieldErrors,
  SubmitHandler,
  UseFormHandleSubmit,
} from "react-hook-form";
import { ILoginParams } from "../../../../../pages/auth/login";
import logoSvg from "../../../../assets/logo.svg";

interface ILoginTempalte {
  control: Control<ILoginParams, any>;
  handleSubmit: UseFormHandleSubmit<ILoginParams>;
  onSubmit: SubmitHandler<ILoginParams>;
  errors: FieldErrors<ILoginParams>;
  isLoading: boolean;
  errorResMessage: string;
}

const LoginTemplate: FC<ILoginTempalte> = (props) => {
  const {
    control,
    handleSubmit,
    onSubmit,
    errors,
    isLoading,
    errorResMessage,
  } = props;

  const [showPassword, setShowPassword] = useState(false);

  return (
    <div className="flex justify-center items-center bg-[#F6F9FC] min-h-screen">
      <Paper
        className="w-full sm:w-[500px] py-8 px-12"
        sx={{ boxShadow: "0px 8px 45px rgb(3 0 71 / 9%)" }}
      >
        <Box>
          <Image
            src={logoSvg}
            alt="DBRR logo"
            className="mx-auto block"
            width={100}
            height={100}
          />
          <h1 className="mb-8 mt-2 text-[16px] font-bold text-center">
            Welcome to DBRR
          </h1>
          {errorResMessage && (
            <Box className="mb-3">
              <Alert severity="error">
                <AlertTitle>Error</AlertTitle>
                {errorResMessage}
              </Alert>
            </Box>
          )}
          <Box component="form" onSubmit={handleSubmit(onSubmit)}>
            <Box className="mb-3">
              <Controller
                name="email"
                control={control}
                render={({ field }) => (
                  <>
                    <InputLabel error={errors.email ? true : false}>
                      Email
                    </InputLabel>
                    <OutlinedInput
                      {...field}
                      // className="py-2 px-3.5"
                      placeholder="abd@gmail.com"
                      fullWidth
                      error={errors.email ? true : false}
                    />
                    <FormHelperText error={errors.email ? true : false}>
                      {errors.email?.message}
                    </FormHelperText>
                  </>
                )}
              />
            </Box>
            <Box className="mb-3">
              <Controller
                name="password"
                control={control}
                render={({ field }) => (
                  <>
                    <InputLabel error={errors.password ? true : false}>
                      Password
                    </InputLabel>
                    <OutlinedInput
                      {...field}
                      placeholder="**********"
                      fullWidth
                      type={showPassword ? "text" : "password"}
                      error={errors.password ? true : false}
                      endAdornment={
                        <InputAdornment position="end">
                          <IconButton
                            aria-label="toggle password visibility"
                            onClick={() => setShowPassword((show) => !show)}
                            onMouseDown={(event) => event.preventDefault()}
                            edge="end"
                          >
                            {showPassword ? (
                              <VisibilityIcon />
                            ) : (
                              <VisibilityOffIcon className="text-[#C0C3C8]" />
                            )}
                          </IconButton>
                        </InputAdornment>
                      }
                    />
                    <FormHelperText error={errors.password ? true : false}>
                      {errors.password?.message}
                    </FormHelperText>
                  </>
                )}
              />
            </Box>
            <LoadingButton
              variant="contained"
              fullWidth
              disableElevation
              className="font-semibold"
              size="large"
              type="submit"
              loading={isLoading}
            >
              Submit
            </LoadingButton>
          </Box>
        </Box>
        <Box className="py-6">
          <Divider className="text-[#7D879C] text-sm w-52 mx-auto">or</Divider>
        </Box>
        <Box className="mb-3">
          <Button
            size="large"
            variant="contained"
            fullWidth
            disableElevation
            className="bg-[#3B5998]"
          >
            Continue with facebook
          </Button>
        </Box>

        <Box className="mb-3">
          <Button
            size="large"
            variant="contained"
            fullWidth
            disableElevation
            className="bg-[#4285F4]"
          >
            Continue with Google
          </Button>
        </Box>
        <Box className="mt-5 flex justify-center text-sm">
          <span>Don't have a account?</span>
          <Link href="/auth/register" className="ml-2">
            Sign up
          </Link>
        </Box>
        <Box className="mt-5 bg-[#F3F5F9] py-5 flex justify-center text-sm">
          <span>Forgot your password?</span>
          <Link href="/auth/reset-password" className="ml-2">
            Reset It
          </Link>
        </Box>
      </Paper>
    </div>
  );
};

export default LoginTemplate;
