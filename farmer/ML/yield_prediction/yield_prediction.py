import pandas as pd
import numpy as np
import sys
from sklearn.ensemble import RandomForestRegressor
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import OneHotEncoder

# ---------------------------------------------------------------
# Load the dataset  (rename CSV to crop_production_india.csv once
# you have the all-India file; just keep the same column structure)
# ---------------------------------------------------------------
df = pd.read_csv("ML\yield_prediction\crop_production_india.csv")

# Strip whitespace from string columns
for col in ['State_Name', 'District_Name', 'Season', 'Crop']:
    df[col] = df[col].str.strip()

# Drop rows with missing target values
df = df.dropna(subset=['Production'])

# Drop the Crop_Year column
df = df.drop(['Crop_Year'], axis=1)

# Separate the features and target variables
X = df.drop(['Production'], axis=1)
y = df['Production']

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Categorical columns for one-hot encoding
categorical_cols = ['State_Name', 'District_Name', 'Season', 'Crop']

# One-hot encode the categorical columns
ohe = OneHotEncoder(handle_unknown='ignore', sparse_output=False)
ohe.fit(X_train[categorical_cols])

# Convert categorical columns to one-hot encoding
X_train_categorical = ohe.transform(X_train[categorical_cols])
X_test_categorical  = ohe.transform(X_test[categorical_cols])

# Combine the one-hot encoded categorical columns and numerical columns
X_train_final = np.hstack((X_train_categorical, X_train.drop(categorical_cols, axis=1).values))
X_test_final  = np.hstack((X_test_categorical,  X_test.drop(categorical_cols, axis=1).values))

# Train the model
model = RandomForestRegressor(n_estimators=100, random_state=42)
model.fit(X_train_final, y_train)

# ---------------------------------------------------------------
# Get the input parameters as command-line arguments
# Usage: python yield_prediction.py <state> <district> <season> <crop> <area>
# ---------------------------------------------------------------
Jstate    = sys.argv[1]
Jdistrict = sys.argv[2]
Jseason   = sys.argv[3]
Jcrops    = sys.argv[4]
Jarea     = sys.argv[5]

user_input = np.array([[Jstate, Jdistrict, Jseason, Jcrops, Jarea]])

# Convert the categorical columns to one-hot encoding
user_input_categorical = ohe.transform(user_input[:, :4])

# Combine the one-hot encoded categorical columns and numerical columns
user_input_final = np.hstack((user_input_categorical, user_input[:, 4:].astype(float)))

# Make the prediction
prediction = model.predict(user_input_final)

# Return the prediction as a string
print(str(round(float(prediction[0]), 2)))